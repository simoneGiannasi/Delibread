<?php
// auth_check.php - File da includere in tutte le pagine protette

session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['IdUtente']) || !isset($_SESSION['Tipo'])) {
    header("Location: index.php");
    exit();
}

// Funzione per verificare il tipo di utente
function checkUserType($requiredType) {
    if ($_SESSION['Tipo'] !== $requiredType) {
        header("Location: index.php");
        exit();
    }
}

// Funzione per ottenere l'ID utente corrente
function getCurrentUserId() {
    return $_SESSION['IdUtente'];
}

// Funzione per ottenere il tipo utente corrente
function getCurrentUserType() {
    return $_SESSION['Tipo'];
}
?>