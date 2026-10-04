<?php
// Start de sessie
session_start();

// Verwijder alle gegevens uit de sessie
session_unset();

// Beëindig de sessie
session_destroy();

// Stuur de gebruiker terug naar de loginpagina
header("Location: login.php");
exit;
?>