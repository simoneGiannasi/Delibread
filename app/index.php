<?php include 'templates/header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="assets/logo.png" alt="DeliBread Logo" class="logo">
            <h1>Accedi a DeliBread</h1>
        </div>

        <form action="login.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="user_type">Tipo di utente</label>
                <select id="user_type" name="user_type" required>
                    <option value="">Seleziona...</option>
                    <option value="utente">Utente</option>
                    <option value="panetteria">Panetteria</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Accedi</button>
        </form>

        <div class="auth-footer">
            <p>Non hai un account? <a href="register.php">Registrati come utente</a> o <a href="register_panetteria.php">Registra la tua panetteria</a></p>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>