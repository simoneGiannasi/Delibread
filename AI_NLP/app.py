from flask import Flask, request, jsonify
import spacy


nlp = spacy.load("en_core_web_sm")


text = ("When Sebastian Thrun started working on self-driving cars at "
        "Google in 2007, few people outside of the company took him "
        "seriously. “I can tell you very senior CEOs of major American "
        "car companies would shake my hand and turn away because I wasn’t "
        "worth talking to,” said Thrun, in an interview with Recode earlier "
        "this week.")
doc = nlp(text)

# Analyze syntax
print("Noun phrases:", [chunk.text for chunk in doc.noun_chunks])
print("Verbs:", [token.lemma_ for token in doc if token.pos_ == "VERB"])

# Find named entities, phrases and concepts
for entity in doc.ents:
    print(entity.text, entity.label_)

app = Flask(__name__)

@app.route('/analyze', methods=['POST'])
def analyze_text():
    data = request.get_json()
    text = data.get('text', '')
    doc = nlp(text)
    
    noun_phrases = [chunk.text for chunk in doc.noun_chunks]
    verbs = [token.lemma_ for token in doc if token.pos_ == "VERB"]
    entities = [(entity.text, entity.label_) for entity in doc.ents]
    
    return jsonify({
        'noun_phrases': noun_phrases,
        'verbs': verbs,
        'entities': entities
    })



if __name__ == '__main__':
    app.run(debug=True, port=5000)