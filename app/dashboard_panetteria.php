<?php
define('BASE_PATH', realpath(__DIR__ . '/../public'));
require_once __DIR__ . '/conf/db_config.php';
require_once __DIR__ . '/functions/auth_check.php';

include __DIR__ . '/templates/header_panetteria.php';

checkUserType('Panettiere');


$idUtente = getCurrentUserId();

$pageTitle = "Ordini DeliBread";

$stmt = $conn->prepare("SELECT IdPanetteria FROM utente WHERE IdUtente = ?");
$stmt->bind_param("i", $idUtente);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$idPanetteria = $row['IdPanetteria'];
$stmt->close();

$stmt = $conn->prepare("SELECT *
FROM ordine o inner join ordine_panetteria op On o.IdOrdine = op.IdOrdine
		inner join panetteria p ON op.IdPanetteria = p.IdPanetteria 
        INNER JOIN utente u ON o.IdUtente = u.IdUtente
WHERE o.Stato not like 'consegnato' and p.IdPanetteria = ? ");

$stmt->bind_param("i", $idPanetteria);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC); // Recupera TUTTE le righe
$stmt->close();

// Calcola statistiche per le card
$totalOrders = count($orders);
$pendingOrders = 0;
$processingOrders = 0;
$readyOrders = 0;

foreach ($orders as $order) {

    switch(strtolower($order['Stato'])) {
        case 'in attesa':
            $pendingOrders++;
            break;
        case 'confermato':
        case 'in preparazione':
            $processingOrders++;
            break;
        case 'pronto':
            $readyOrders++;
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle . " - ". $_SESSION['Nome']; ?> </title>
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <script src="/public/assets/js/app.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <?php include 'templates/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <?php include 'templates/header.php'; ?>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <div class="main-section">
                    <!-- Order Summary Cards -->
                    <div class="order-cards">
                        <div class="order-card total-orders">
                            <div class="card-header">Totale Ordini</div>
                            <div class="card-content"><?php echo $totalOrders; ?></div>
                        </div>
                        
                        <div class="order-card pending-orders">
                            <div class="card-header">In Attesa</div>
                            <div class="card-content"><?php echo $pendingOrders; ?></div>
                        </div>
                        
                        <div class="order-card processing-orders">
                            <div class="card-header">In Preparazione</div>
                            <div class="card-content"><?php echo $processingOrders; ?></div>
                        </div>
                        
                        <div class="order-card ready-orders">
                            <div class="card-header">Pronti</div>
                            <div class="card-content"><?php echo $readyOrders; ?></div>
                        </div>
                    </div>
                    
                    <!-- Orders List -->
                    <div class="orders-section">
                        <h2>Lista Ordini Attivi</h2>
                        
                        <?php if (empty($orders)): ?>
                            <div class="no-orders">
                                <p>Nessun ordine attivo al momento.</p>
                            </div>
                        <?php else: ?>
                            <div class="orders-table">
                                <div class="table-header">
                                    <div class="col-date">Data</div>
                                    <div class="col-customer">Cliente</div>
                                    <div class="col-status">Stato</div>
                                    <div class="col-total">Totale</div>
                                    <div class="col-actions">Azioni</div>
                                </div>
                                
                                <?php foreach ($orders as $order): ?>
                                <div class="order-row" data-status="<?php  echo strtolower($order['Stato']); ?>">

                                    <div class="col-date">
                                        <?php echo date('d/m/Y H:i', strtotime($order['DataCreazione'])); ?>
                                    </div>
                                    <div class="col-customer">
                                        <?php echo htmlspecialchars($order['Nome'] . ' ' . $order['Cognome'] ?? 'N/A'); ?>
                                    </div>
                                    <div class="col-status">
                                        <span class="status-badge status-<?php echo str_replace([' ', 'à'], ['', 'a'], strtolower($order['Stato'])); ?>">
                                            <?php echo ucfirst($order['Stato']); ?>
                                        </span>
                                    </div>
                                    <div class="col-total">
                                        €<?php echo number_format($order['TotaleOrdine'] ?? 0, 2, ',', '.'); ?>
                                    </div>
                                    <div class="col-actions">
                                        <button class="btn-view" onclick="viewOrder(<?php echo $order['IdOrdine']; ?>)">
                                            Visualizza
                                        </button>
                                        
                                        <?php if (strtolower($order['Stato']) == 'In attesa'): ?>
                                            <button class="btn-accept" onclick="updateOrderStatus(<?php echo $order['IdOrdine']; ?>, 'Confermato')">
                                                Accetta
                                            </button>
                                        <?php elseif (strtolower($order['Stato']) == 'Confermato'): ?>
                                            <button class="btn-ready" onclick="updateOrderStatus(<?php echo $order['IdOrdine']; ?>, 'In preparazione')">
                                                Prepara
                                            </button>
                                        <?php elseif (strtolower($order['Stato']) == 'Pronto'): ?>
                                            <button class="btn-deliver" onclick="updateOrderStatus(<?php echo $order['IdOrdine']; ?>, 'Consegnato')">
                                                Consegna
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Sidebar Right (Calendar) -->
                <div class="sidebar-right">
                    <?php include 'templates/calendar.php'; ?>
                </div>
            </div>
        </div>
    </div>


      