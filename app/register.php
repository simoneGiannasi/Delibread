<?php 
require_once 'conf/db_config.php'; // Connessione al database

// Query per ottenere i ruoli dalla tabella utente
$queryRuoli = "SELECT DISTINCT Tipo FROM utente";
$resultRuoli = mysqli_query($conn, $queryRuoli);

// Query per ottenere le panetterie
$queryPanetterie = "SELECT IdPanetteria, Nome FROM panetteria";
$resultPanetterie = mysqli_query($conn, $queryPanetterie);

$page_title = "Registrazione Utente";
include 'templates/header.php'; 
?>

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

            <div class="form-group">
                <label for="ruolo">Che ruolo ricopri?</label>
                <select id="ruolo" name="ruolo" required>
                    <option value="">Seleziona il tuo ruolo...</option>
                    <?php while($row = mysqli_fetch_assoc($resultRuoli)): ?>
                        <option value="<?php echo $row['Tipo']; ?>">
                            <?php echo htmlspecialchars($row['Tipo']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="panetteria">In quale panetteria?</label>
                <select id="panetteria" name="panetteria">
                    <option value="">Seleziona la panetteria...</option>
                    <?php while($row = mysqli_fetch_assoc($resultPanetterie)): ?>
                        <option value="<?php echo $row['IdPanetteria']; ?>">
                            <?php echo htmlspecialchars($row['Nome']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
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

<?php 
// Chiudi le connessioni
mysqli_free_result($resultRuoli);
mysqli_free_result($resultPanetterie);
mysqli_close($conn);

include 'templates/footer.php'; 
?>