<?php
session_start();
include 'conf/db_config.php';
include 'templates/header.php';

$user = [
    'nome' => 'Mario',
    'cognome' => 'Rossi'
];
?>

<div class="client-container">
    <?php include 'templates/client_nav.php'; ?>
    
    <main class="client-main">
        <div class="content-header">
            <h1>Ordini ricorrenti</h1>
        </div>
        
        <div class="content-body">
            <section class="card">
                <div class="section-header">
                    <h2>I tuoi ordini programmati</h2>
                    <button class="btn-primary">+ Nuovo ordine ricorrente</button>
                </div>
                
                <div class="recurring-orders">
                    <!-- Ordine 1 -->
                    <div class="order-item">
                        <div class="order-info">
                            <h3>Ordine settimanale</h3>
                            <p>Panetteria Mario - Ogni Lunedì</p>
                            <p class="order-desc">2 kg pane integrale, 3 cornetti</p>
                        </div>
                        <div class="order-actions">
                            <button class="btn-edit">Modifica</button>
                            <button class="btn-delete">Elimina</button>
                        </div>
                    </div>
                    
                    <!-- Ordine 2 -->
                    <div class="order-item">
                        <div class="order-info">
                            <h3>Ordine mensile</h3>
                            <p>Pane e Vino - Ogni 1° del mese</p>
                            <p class="order-desc">5 kg pane di segale, 10 brioche</p>
                        </div>
                        <div class="order-actions">
                            <button class="btn-edit">Modifica</button>
                            <button class="btn-delete">Elimina</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<?php include 'templates/footer.php'; ?>