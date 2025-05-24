<?php include 'templates/header.php'; 
require_once 'conf/db_config.php';
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT IdUtente, Tipo FROM Utente WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        $idUtente = $row['IdUtente'];
        $tipo = $row['Tipo'];
        if ($tipo == 'Panettiere') {
            header("Location: dashboard_panetteria.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('Email o password errati.');</script>";
    }
}
if (isset($_SESSION['IdUtente'])) {
    if ($_SESSION['Tipo'] == 'Panettiere') {
        header("Location: dashboard_panetteria.php");
    } else {
        header("Location: dashboard.php");
    }
    header("Location: index.php");
    exit();
}

session_destroy();

?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="assets/logo.png" alt="DeliBread Logo" class="logo">
            <h1>ti è piaciuta la pagnotta adesso la cavalchi</h1>
        </div>

        <form action="index.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>


            <button type="submit" class="btn-primary">Accedi</button>
        </form>

        <div class="auth-footer">
            <p>Non hai un account? <a href="register.php">Registrati come utente</a> o <a href="register_panetteria.php">Registra la tua panetteria</a></p>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>