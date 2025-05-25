<?php
session_start();
include 'conf/db_config.php';
include 'templates/header.php';

// Dati utente di esempio
$user = [
    'nome' => 'Mario',
    'cognome' => 'Rossi'
];
?>

<div class="client-container">
    <?php include 'templates/client_nav.php'; ?>
    
    <main class="client-main">
        <div class="content-header">
            <h1>Effettua un ordine</h1>
        </div>
        
        <div class="content-body">
            <section class="card">
                <h2>Descrivi il tuo ordine</h2>
                <form class="order-form">
                    <div class="form-group">
                        <label for="panetteria">Seleziona panetteria</label>
                        <select id="panetteria" name="panetteria" required>
                            <option value="">-- Seleziona --</option>
                            <option value="1">Panetteria Mario</option>
                            <option value="2">Pane e Vino</option>
                            <option value="3">Il Fornaio</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="ordine">Cosa desideri ordinare?</label>
                        <textarea id="ordine" name="ordine" rows="5" 
                                  placeholder="Es: 2 kg di pane integrale, 5 cornetti alla crema..." 
                                  required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Note aggiuntive</label>
                        <textarea id="note" name="note" rows="3" 
                                  placeholder="Allergie, orario di ritiro..."></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="reset" class="btn-secondary">Annulla</button>
                        <button type="submit" class="btn-primary">Invia ordine</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</div>

<?php include 'templates/footer.php'; ?>