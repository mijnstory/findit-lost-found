<?php
// Start de sessie
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Alleen medewerkers mogen statussen aanpassen
if ($_SESSION["role"] != "medewerker") {
    die("Geen toegang tot deze pagina.");
}

// Haal de databaseverbinding op
require_once "config/database.php";

// Controleer of er een id en type zijn meegestuurd
if (!isset($_GET["id"]) || !isset($_GET["type"])) {
    die("Ongeldige aanvraag.");
}

// Haal gegevens uit de URL
$id = (int) $_GET["id"];
$type = $_GET["type"];

// Controleer welk soort voorwerp aangepast moet worden
if ($type == "found") {
    $table = "found_items";
} elseif ($type == "lost") {
    $table = "lost_items";
} else {
    die("Ongeldig type.");
}

// Controleer of het formulier is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Haal de gekozen status op
    $status = $_POST["status"];

    // Alleen deze statussen zijn toegestaan
    $allowedStatuses = ["open", "match gevonden", "afgehandeld"];

    if (in_array($status, $allowedStatuses)) {

        // Werk de status bij in de database
        $stmt = $pdo->prepare(
            "UPDATE $table SET status = ? WHERE id = ?"
        );

        $stmt->execute([
            $status,
            $id
        ]);

        $message = "Status succesvol aangepast.";

    } else {
        $message = "Ongeldige status.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Status wijzigen - FindIt</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Status wijzigen</h1>

    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Formulier om de status te wijzigen -->
    <form method="POST">

        <label for="status">Nieuwe status:</label>

        <select name="status" id="status" required>
            <option value="open">Open</option>
            <option value="match gevonden">Match gevonden</option>
            <option value="afgehandeld">Afgehandeld</option>
        </select>

        <br><br>

        <button type="submit">Status aanpassen</button>

    </form>

    <p>
        <a href="dashboard.php">Terug naar dashboard</a>
    </p>

</body>

</html>