<?php
// Start de sessie
session_start();

// Controleer of de gebruiker al is ingelogd
if (isset($_SESSION["user_id"])) {

    // Ingelogde gebruiker gaat naar het dashboard
    header("Location: dashboard.php");

} else {

    // Niet ingelogde gebruiker gaat naar de loginpagina
    header("Location: login.php");
}

exit;
?>