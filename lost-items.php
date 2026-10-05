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

// Haal alleen de verliesmeldingen op van de ingelogde gebruiker
$stmt = $pdo->prepare(
    "SELECT * FROM lost_items
    WHERE user_id = ?
    ORDER BY created_at DESC"
);

$stmt->execute([
    $_SESSION["user_id"]
]);

// Haal alle verliesmeldingen op
$lostItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Mijn verliesmeldingen - FindIt</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Mijn verliesmeldingen</h1>

    <!-- Controleer of er meldingen zijn -->
    <?php if (count($lostItems) == 0): ?>

        <p>Je hebt nog geen verliesmeldingen.</p>

    <?php else: ?>

        <!-- Toon alle verliesmeldingen van deze gebruiker -->
        <?php foreach ($lostItems as $item): ?>

            <div>

                <h2>
                    <?php echo htmlspecialchars($item["title"]); ?>
                </h2>

                <p>
                    <strong>Categorie:</strong>
                    <?php echo htmlspecialchars($item["category"]); ?>
                </p>

                <p>
                    <strong>Beschrijving:</strong>
                    <?php echo htmlspecialchars($item["description"]); ?>
                </p>

                <p>
                    <strong>Locatie:</strong>
                    <?php echo htmlspecialchars($item["location"]); ?>
                </p>

                <p>
                    <strong>Datum verloren:</strong>
                    <?php echo htmlspecialchars($item["lost_date"]); ?>
                </p>

                <p>
                    <strong>Status:</strong>
                    <?php echo htmlspecialchars($item["status"]); ?>
                </p>

                <!-- Alleen medewerkers mogen de status aanpassen -->
                <?php if ($_SESSION["role"] == "medewerker"): ?>

                    <p>
                        <a href="update-status.php?id=<?php echo $item["id"]; ?>&type=lost">
                            Status wijzigen
                        </a>
                    </p>

                <?php endif; ?>

                <hr>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

    <p>
        <a href="dashboard.php">Terug naar dashboard</a>
    </p>

</body>

</html>