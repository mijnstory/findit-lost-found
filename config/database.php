<?php

// Gegevens om verbinding te maken met de database
$host = "localhost";
$dbname = "findit_db";
$username = "root";
$password = "";

// Probeer verbinding te maken met de database
try {

    // Maak een nieuwe PDO databaseverbinding
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    // Zorg ervoor dat databasefouten zichtbaar worden
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    // Stop de pagina als de databaseverbinding mislukt
    die("Databaseverbinding mislukt: " . $e->getMessage());
}
?>