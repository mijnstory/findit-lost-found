<?php
// Start de sessie
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Alleen medewerkers mogen gevonden voorwerpen registreren
if ($_SESSION["role"] != "medewerker") {
    die("Geen toegang tot deze pagina.");
}

// Haal de databaseverbinding op
require_once "config/database.php";

// Variabele voor meldingen
$message = "";

// Controleer of het formulier is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Haal de ingevulde gegevens op
    $title = trim($_POST["title"]);
    $category = trim($_POST["category"]);
    $description = trim($_POST["description"]);
    $location = trim($_POST["location"]);
    $found_date = $_POST["found_date"];

    // Controleer of alle velden zijn ingevuld
    if (
        empty($title) ||
        empty($category) ||
        empty($description) ||
        empty($location) ||
        empty($found_date)
    ) {
        $message = "Vul alle velden in.";
    } else {

        // Voeg het gevonden voorwerp toe aan de database
        $stmt = $pdo->prepare(
            "INSERT INTO found_items
            (user_id, title, category, description, location, found_date)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->execute([
            $_SESSION["user_id"],
            $title,
            $category,
            $description,
            $location,
            $found_date
        ]);

        $message = "Gevonden voorwerp succesvol opgeslagen.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Gevonden voorwerp registreren - FindIt</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Gevonden voorwerp registreren</h1>

    <!-- Toon een melding -->
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Formulier voor gevonden voorwerpen -->
    <form method="POST" action="">

        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>

        <br><br>

        <label for="category">Categorie:</label>
        <input type="text" id="category" name="category" required>

        <br><br>

        <label for="description">Beschrijving:</label>
        <textarea id="description" name="description" required></textarea>

        <br><br>

        <label for="location">Locatie gevonden:</label>
        <input type="text" id="location" name="location" required>

        <br><br>

        <label for="found_date">Datum gevonden:</label>
        <input type="date" id="found_date" name="found_date" required>

        <br><br>

        <button type="submit">Opslaan</button>

    </form>

    <p>
        <a href="dashboard.php">Terug naar dashboard</a>
    </p>

</body>

</html>