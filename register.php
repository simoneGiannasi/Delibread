<?php include 'templates/header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="assets/logo.png" alt="DeliBread Logo" class="logo">
            <h1>Registrazione Utente</h1>
        </div>

        <form action="register_process.php" method="POST" class="auth-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="cognome">Cognome</label>
                    <input type="text" id="cognome" name="cognome" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Conferma Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <input type="hidden" name="user_type" value="utente">

            <button type="submit" class="btn-primary">Registrati</button>
        </form>

        <div class="auth-footer">
            <p>Hai già un account? <a href="index.php">Accedi</a></p>
            <p>Sei una panetteria? <a href="register_panetteria.php">Registrati qui</a></p>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>