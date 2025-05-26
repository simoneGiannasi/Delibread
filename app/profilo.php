<?php
session_start();
include 'conf/db_config.php';
include 'templates/header.php';

// Dati utente di esempio (sostituire con query al DB)
$user = [
    'nome' => 'Mario',
    'cognome' => 'Rossi',
    'email' => 'mario.rossi@example.com',
    'telefono' => '1234567890',
    'indirizzo' => 'Via Roma 123, Milano'
];
?>

<div class="client-container">
    <?php include 'templates/client_nav.php'; ?>
    
    <main class="client-main">
        <div class="content-header">
            <h1>Il tuo profilo</h1>
        </div>
        
        <div class="content-body">
            <section class="card profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <?php 
                        $iniziali = strtoupper(substr($user['nome'], 0, 1) . substr($user['cognome'], 0, 1));
                        echo $iniziali; 
                        ?>
                    </div>
                    <h2><?php echo htmlspecialchars($user['nome'] . ' ' . $user['cognome']); ?></h2>
                </div>
                
                <div class="profile-info">
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['email']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Telefono:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['telefono']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Indirizzo:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['indirizzo']); ?></span>
                    </div>
                </div>
                
                <div class="profile-actions">
                    <button class="btn-primary">Modifica profilo</button>
                    <button class="btn-secondary">Cambia password</button>
                </div>
            </section>
        </div>
    </main>
</div>

<?php include 'templates/footer.php'; ?>