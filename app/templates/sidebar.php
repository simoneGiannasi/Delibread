<?php
// templates/sidebar.php
?>
<div class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <span class="logo-icon">🌐</span>
            <span class="logo-text">Delibread</span>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon">👥</span>
                    <span class="nav-text">Amministrazione</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <button class="logout-btn"onclick="window.location.href='functions/logout.php'">
            <span class="logout-icon" >🚪</span>
            <span class="logout-text">Logout</span>
            <a href="../functions/logout.php"></a>
        </button>
        <div class="copyright">
            © 2025 Delibread ERP
        </div>
    </div>
</div>