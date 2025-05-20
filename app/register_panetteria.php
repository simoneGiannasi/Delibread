<?php include 'templates/header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="assets/logo.png" alt="DeliBread Logo" class="logo">
            <h1>Registrazione Panetteria</h1>
        </div>

        <form action="register_process.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="nome">Nome Panetteria</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="piva">Partita IVA</label>
                <input type="text" id="piva" name="piva" required>
            </div>

            <div class="form-group">
                <label for="ragione_sociale">Ragione Sociale</label>
                <input type="text" id="ragione_sociale" name="ragione_sociale">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="via">Via</label>
                    <input type="text" id="via" name="via">
                </div>
                <div class="form-group">
                    <label for="nciv">Numero Civico</label>
                    <input type="text" id="nciv" name="nciv">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="citta">Città</label>
                    <input type="text" id="citta" name="citta">
                </div>
                <div class="form-group">
                    <label for="cap">CAP</label>
                    <input type="text" id="cap" name="cap">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="provincia">Provincia</label>
                    <input type="text" id="provincia" name="provincia" maxlength="2">
                </div>
                <div class="form-group">
                    <label for="regione">Regione</label>
                    <input type="text" id="regione" name="regione">
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

            <div class="form-group">
                <label for="orario_limite">Orario limite ordine (ore)</label>
                <input type="number" id="orario_limite" name="orario_limite" min="0" max="23" value="12">
            </div>

            <input type="hidden" name="user_type" value="panetteria">

            <button type="submit" class="btn-primary">Registra Panetteria</button>
        </form>

        <div class="auth-footer">
            <p>Hai già un account? <a href="index.php">Accedi</a></p>
            <p>Sei un utente? <a href="register.php">Registrati qui</a></p>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>