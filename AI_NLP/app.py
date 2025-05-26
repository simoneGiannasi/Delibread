from flask import Flask, request, jsonify
from flask_cors import CORS
import spacy
from datetime import datetime, timedelta
import re

# Carica il modello spaCy
try:
    nlp = spacy.load("en_core_web_sm")
except OSError:
    print("Modello spaCy non trovato. Installa con: python -m spacy download en_core_web_sm")
    exit(1)

app = Flask(__name__)
CORS(app)  # Permette richieste da PHP

class OrderAnalyzer:
    def __init__(self):
        # Lista di prodotti comuni (espandibile)
        self.products = [
            'pizza', 'hamburger', 'pasta', 'risotto', 'insalata', 'panino',
            'bistecca', 'pesce', 'pollo', 'gelato', 'torta', 'caffè', 'tè',
            'acqua', 'vino', 'birra', 'coca cola', 'spremuta', 'frutta',
            'verdura', 'pane', 'formaggio', 'prosciutto', 'salame'
        ]
        
        # Pattern per quantità
        self.quantity_patterns = [
            r'(\d+)\s*(pezzi?|porzioni?|kg|grammi?|g|litri?|l|ml|bottiglie?)',
            r'(un[ao]?|due|tre|quattro|cinque|sei|sette|otto|nove|dieci)',
            r'(\d+)(?=\s+\w+)'  # numero seguito da parola
        ]
        
        # Pattern per date/tempi
        self.time_patterns = [
            r'per\s+(domani|oggi|dopodomani)',
            r'entro\s+(il\s+)?(\d{1,2}[/-]\d{1,2})',
            r'per\s+(lunedì|martedì|mercoledì|giovedì|venerdì|sabato|domenica)',
            r'tra\s+(\d+)\s+(giorni?|ore|minuti?)',
            r'alle\s+(\d{1,2}):?(\d{2})?',
            r'(\d{1,2}[/-]\d{1,2}[/-]?\d{0,4})'
        ]

    def extract_products(self, text):
        """Estrae prodotti dal testo"""
        text_lower = text.lower()
        found_products = []
        
        # Cerca prodotti nella lista predefinita
        for product in self.products:
            if product in text_lower:
                found_products.append(product)
        
        # Usa spaCy per trovare sostantivi che potrebbero essere prodotti
        doc = nlp(text)
        for token in doc:
            if (token.pos_ == "NOUN" and 
                len(token.text) > 2 and 
                token.text.lower() not in found_products):
                # Controlla se è un possibile prodotto alimentare
                if any(label in token.ent_type_ for label in ["PRODUCT", "FOOD"]) or \
                   token.text.lower() in text_lower:
                    found_products.append(token.text.lower())
        
        return list(set(found_products))  # Rimuovi duplicati

    def extract_quantity(self, text):
        """Estrae quantità dal testo"""
        quantities = []
        text_lower = text.lower()
        
        # Numeri in parole italiane
        word_numbers = {
            'un': 1, 'una': 1, 'uno': 1,
            'due': 2, 'tre': 3, 'quattro': 4, 'cinque': 5,
            'sei': 6, 'sette': 7, 'otto': 8, 'nove': 9, 'dieci': 10
        }
        
        for pattern in self.quantity_patterns:
            matches = re.finditer(pattern, text_lower)
            for match in matches:
                if match.group(1).isdigit():
                    qty = int(match.group(1))
                    unit = match.group(2) if len(match.groups()) > 1 else "pezzi"
                    quantities.append(f"{qty} {unit}")
                elif match.group(1) in word_numbers:
                    qty = word_numbers[match.group(1)]
                    quantities.append(f"{qty} pezzi")
        
        # Se non trova quantità specifiche, cerca solo numeri
        if not quantities:
            numbers = re.findall(r'\b(\d+)\b', text)
            if numbers:
                quantities = [f"{num} pezzi" for num in numbers]
        
        return quantities if quantities else ["1 pezzo"]

    def extract_deadline(self, text):
        """Estrae scadenza/quando dal testo"""
        text_lower = text.lower()
        deadlines = []
        
        # Parole chiave temporali italiane
        today = datetime.now()
        
        if 'oggi' in text_lower:
            deadlines.append(today.strftime('%Y-%m-%d'))
        elif 'domani' in text_lower:
            tomorrow = today + timedelta(days=1)
            deadlines.append(tomorrow.strftime('%Y-%m-%d'))
        elif 'dopodomani' in text_lower:
            day_after = today + timedelta(days=2)
            deadlines.append(day_after.strftime('%Y-%m-%d'))
        
        # Giorni della settimana
        days_map = {
            'lunedì': 0, 'martedì': 1, 'mercoledì': 2, 'giovedì': 3,
            'venerdì': 4, 'sabato': 5, 'domenica': 6
        }
        
        for day_name, day_num in days_map.items():
            if day_name in text_lower:
                days_ahead = (day_num - today.weekday()) % 7
                if days_ahead == 0:  # Stesso giorno
                    days_ahead = 7  # Prossima settimana
                target_date = today + timedelta(days=days_ahead)
                deadlines.append(target_date.strftime('%Y-%m-%d'))
        
        # Pattern per date specifiche
        for pattern in self.time_patterns:
            matches = re.finditer(pattern, text_lower)
            for match in matches:
                if 'tra' in match.group(0):
                    # "tra X giorni"
                    num = int(match.group(1))
                    target_date = today + timedelta(days=num)
                    deadlines.append(target_date.strftime('%Y-%m-%d'))
                elif re.match(r'\d{1,2}[/-]\d{1,2}', match.group(0)):
                    # Data formato dd/mm o dd-mm
                    deadlines.append(match.group(0))
        
        return deadlines if deadlines else ["Non specificato"]

    def analyze_order(self, text):
        """Analizza l'ordine completo"""
        return {
            'prodotti': self.extract_products(text),
            'quantita': self.extract_quantity(text),
            'scadenza': self.extract_deadline(text),
            'testo_originale': text
        }

# Inizializza l'analizzatore
analyzer = OrderAnalyzer()

@app.route('/', methods=['GET'])
def home():
    return jsonify({
        'status': 'API Attiva',
        'endpoints': {
            '/analyze': 'POST - Analizza testo ordine',
            '/test': 'GET - Test con esempi'
        }
    })

@app.route('/analyze', methods=['POST'])
def analyze_text():
    try:
        data = request.get_json()
        if not data or 'text' not in data:
            return jsonify({'error': 'Testo mancante'}), 400
        
        text = data.get('text', '')
        if not text.strip():
            return jsonify({'error': 'Testo vuoto'}), 400
        
        # Analizza l'ordine
        result = analyzer.analyze_order(text)
        
        # Aggiungi analisi spaCy base
        doc = nlp(text)
        result['entita_riconosciute'] = [(ent.text, ent.label_) for ent in doc.ents]
        result['pos_tags'] = [(token.text, token.pos_) for token in doc]
        
        return jsonify(result)
        
    except Exception as e:
        return jsonify({'error': f'Errore nell\'analisi: {str(e)}'}), 500

@app.route('/test', methods=['GET'])
def test_examples():
    """Endpoint per testare con esempi"""
    examples = [
        "Vorrei 2 pizze margherita per domani sera",
        "Ho bisogno di 3 kg di pasta per venerdì",
        "Ordinerei una torta al cioccolato entro il 15/12",
        "Mi servono 5 bottiglie di vino per la festa di sabato"
    ]
    
    results = []
    for example in examples:
        result = analyzer.analyze_order(example)
        results.append(result)
    
    return jsonify({'esempi': results})

if __name__ == '__main__':
    print("🚀 Server Flask avviato su http://localhost:5000")
    print("📝 Endpoint disponibili:")
    print("   - GET  /     -> Info API")
    print("   - POST /analyze -> Analizza testo")
    print("   - GET  /test -> Esempi di test")
    app.run(debug=True, host='0.0.0.0', port=5000)