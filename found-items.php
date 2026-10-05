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

// Haal alle gevonden voorwerpen op uit de database
$stmt = $pdo->prepare(
    "SELECT * FROM found_items
    ORDER BY created_at DESC"
);

// Voer de query uit
$stmt->execute();

// Haal alle gevonden voorwerpen op
$foundItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Gevonden voorwerpen - FindIt</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Gevonden voorwerpen</h1>

    <!-- Controleer of er gevonden voorwerpen zijn -->
    <?php if (count($foundItems) == 0): ?>

        <p>Er zijn nog geen gevonden voorwerpen geregistreerd.</p>

    <?php else: ?>

        <!-- Toon ieder gevonden voorwerp -->
        <?php foreach ($foundItems as $item): ?>

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
                    <strong>Datum gevonden:</strong>
                    <?php echo htmlspecialchars($item["found_date"]); ?>
                </p>

                <p>
                    <strong>Status:</strong>
                    <?php echo htmlspecialchars($item["status"]); ?>
                </p>

                <!-- Alleen medewerkers mogen de status aanpassen -->
                <?php if ($_SESSION["role"] == "medewerker"): ?>

                    <p>
                        <a href="update-status.php?id=<?php echo $item["id"]; ?>&type=found">
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