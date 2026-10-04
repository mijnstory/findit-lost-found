<?php
// Start de sessie
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION["user_id"])) {

    // Niet ingelogd? Terug naar de loginpagina
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - FindIt</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Toon de naam van de ingelogde gebruiker -->
    <h1>Welkom <?php echo htmlspecialchars($_SESSION["name"]); ?></h1>

    <p>Je bent succesvol ingelogd bij FindIt.</p>

    <!-- Navigatie naar de belangrijkste functies -->
    <ul>
        <li>
            <a href="report-lost.php">Verloren voorwerp melden</a>
        </li>

        <li>
            <a href="lost-items.php">Mijn verliesmeldingen</a>
        </li>

        <li>
            <a href="found-items.php">Gevonden voorwerpen bekijken</a>
        </li>

        <?php if ($_SESSION["role"] == "medewerker"): ?>
            <li>
                <a href="report-found.php">Gevonden voorwerp registreren</a>
            </li>
        <?php endif; ?>

        <li>
            <a href="logout.php">Uitloggen</a>
        </li>
    </ul>

</body>

</html>