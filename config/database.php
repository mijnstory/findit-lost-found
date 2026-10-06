<?php

// Gegevens voor de lokale database
$host = "localhost";
$dbname = "findit_db";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Er is een probleem met de databaseverbinding.");
}
?>