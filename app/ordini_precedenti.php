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
            <h1>Ordini precedenti</h1>
            <div class="search-box">
                <input type="text" placeholder="Cerca ordini...">
                <button class="search-btn">🔍</button>
            </div>
        </div>
        
        <div class="content-body">
            <section class="card">
                <div class="orders-list">
                    <!-- Ordine 1 -->
                    <div class="order-item">
                        <div class="order-header">
                            <h3>Ordine #12345</h3>
                            <span class="order-date">15 Mag 2023</span>
                            <span class="order-status completed">Completato</span>
                        </div>
                        <div class="order-details">
                            <p>Panetteria Mario</p>
                            <p>2 kg pane integrale, 5 cornetti</p>
                            <span class="order-total">12.50 €</span>
                        </div>
                    </div>
                    
                    <!-- Ordine 2 -->
                    <div class="order-item">
                        <div class="order-header">
                            <h3>Ordine #12344</h3>
                            <span class="order-date">8 Mag 2023</span>
                            <span class="order-status completed">Completato</span>
                        </div>
                        <div class="order-details">
                            <p>Pane e Vino</p>
                            <p>3 kg pane di segale, 10 brioche</p>
                            <span class="order-total">18.00 €</span>
                        </div>
                    </div>
                </div>
                
                <div class="pagination">
                    <button class="btn-prev">❮ Precedente</button>
                    <span>Pagina 1 di 3</span>
                    <button class="btn-next">Successivo ❯</button>
                </div>
            </section>
        </div>
    </main>
</div>

<?php include 'templates/footer.php'; ?>