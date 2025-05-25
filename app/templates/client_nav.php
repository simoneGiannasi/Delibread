<aside class="client-sidebar">
    <div class="sidebar-header">
        <div class="user-avatar">
            <?php 
            // Mostra le iniziali dell'utente
            $iniziali = strtoupper(substr($user['nome'], 0, 1) . substr($user['cognome'], 0, 1));
            echo $iniziali; 
            ?>
        </div>
        <h3><?php echo htmlspecialchars($user['nome'] . ' ' . $user['cognome']); ?></h3>
        <p>Cliente</p>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="profilo.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'profilo.php' ? 'active' : ''; ?>">
                    <span class="nav-icon">👤</span>
                    <span class="nav-text">Profilo</span>
                </a>
            </li>
            <li>
                <a href="ordina.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'ordina.php' ? 'active' : ''; ?>">
                    <span class="nav-icon">🛒</span>
                    <span class="nav-text">Effettua un ordine</span>
                </a>
            </li>
            <li>
                <a href="ordini_ricorrenti.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'ordini_ricorrenti.php' ? 'active' : ''; ?>">
                    <span class="nav-icon">🔄</span>
                    <span class="nav-text">Ordini ricorrenti</span>
                </a>
            </li>
            <li>
                <a href="ordini_precedenti.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'ordini_precedenti.php' ? 'active' : ''; ?>">
                    <span class="nav-icon">📋</span>
                    <span class="nav-text">Visualizza ordini precedenti</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <a href="index.php" class="logout-btn">
            <span class="nav-icon">🚪</span>
            <span class="nav-text">Esci</span>
        </a>
    </div>
</aside>