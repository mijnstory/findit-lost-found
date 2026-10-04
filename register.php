<?php
// Haal de databaseverbinding op
require_once "config/database.php";

// Variabele voor meldingen aan de gebruiker
$message = "";

// Controleer of het formulier is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Haal de ingevulde gegevens op
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Controleer of alle velden zijn ingevuld
    if (empty($name) || empty($email) || empty($password)) {
        $message = "Vul alle velden in.";
    } else {

        // Controleer of het e-mailadres al bestaat
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $message = "Dit e-mailadres is al geregistreerd.";
        } else {

            // Maak van het wachtwoord een veilige hash
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Voeg de nieuwe gebruiker toe aan de database
            $stmt = $pdo->prepare(
                "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
            );

            $stmt->execute([
                $name,
                $email,
                $hashedPassword
            ]);

            $message = "Account succesvol aangemaakt.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Registreren - FindIt</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Registreren</h1>

    <!-- Toon een melding als er iets is gebeurd -->
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Registratieformulier -->
    <form method="POST" action="">

        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" required>

        <br><br>

        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" required>

        <br><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>

        <br><br>

        <button type="submit">Registreren</button>

    </form>

    <p>
        Heb je al een account?
        <a href="login.php">Inloggen</a>
    </p>

</body>

</html>