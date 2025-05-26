<header class="main-header">
    <div class="header-left">
        <h1 class="page-title"><?php echo $pageTitle ?? 'Dashboard'; ?></h1>
    </div>
    
    <div class="header-center">
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search">
            <button class="search-btn">🔍</button>
        </div>
    </div>
    
    <div class="header-right">
        <div class="header-actions">
            <button class="header-btn">
                <span class="btn-icon">🔔</span>
            </button>
            <div class="user-profile">
                <div class="user-avatar"><?php echo  htmlspecialchars($_SESSION['Nome'][0]) ?? "A"; ?></div>
                <div class="user-info">
                    <span class="user-name"><?php echo htmlspecialchars($_SESSION['Nome']); echo " " . htmlspecialchars($_SESSION['Cognome']); ?></span>
                    <span class="user-role"><?php echo htmlspecialchars($_SESSION['Tipo']); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>