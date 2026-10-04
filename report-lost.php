<?php
// Start de sessie
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
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
    $lost_date = $_POST["lost_date"];
    $secret_feature = trim($_POST["secret_feature"]);

    // Controleer of verplichte velden zijn ingevuld
    if (
        empty($title) ||
        empty($category) ||
        empty($description) ||
        empty($location) ||
        empty($lost_date)
    ) {
        $message = "Vul alle verplichte velden in.";
    } else {

        // Voeg de verliesmelding toe aan de database
        $stmt = $pdo->prepare(
            "INSERT INTO lost_items
            (user_id, title, category, description, location, lost_date, secret_feature)
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->execute([
            $_SESSION["user_id"],
            $title,
            $category,
            $description,
            $location,
            $lost_date,
            $secret_feature
        ]);

        $message = "Verliesmelding succesvol opgeslagen.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Verloren voorwerp melden - FindIt</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Verloren voorwerp melden</h1>

    <!-- Toon een melding -->
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Formulier voor een verloren voorwerp -->
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

        <label for="location">Locatie verloren:</label>
        <input type="text" id="location" name="location" required>

        <br><br>

        <label for="lost_date">Datum verloren:</label>
        <input type="date" id="lost_date" name="lost_date" required>

        <br><br>

        <label for="secret_feature">Verborgen kenmerk:</label>
        <input type="text" id="secret_feature" name="secret_feature">

        <br><br>

        <button type="submit">Melding opslaan</button>

    </form>

    <p>
        <a href="dashboard.php">Terug naar dashboard</a>
    </p>

</body>

</html>