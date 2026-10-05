<?php
// Databaseverbinding ophalen
require_once "config/database.php";

$message = "";

// Controleer of het formulier is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Gegevens uit het formulier halen
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Basiscontrole
    if (empty($name) || empty($email) || empty($password)) {

        $message = "Vul alle velden in.";

    } elseif (strlen($password) < 8) {

        $message = "Wachtwoord moet minimaal 8 tekens zijn.";

    } else {

        // Controleer of e-mailadres al bestaat
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {

            $message = "Dit e-mailadres bestaat al.";

        } else {

            // Wachtwoord veilig opslaan
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Gebruiker toevoegen
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

    <!-- Melding tonen -->
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Registratieformulier -->
    <form method="POST">

        <label>Naam:</label>
        <input type="text" name="name" required>

        <label>E-mailadres:</label>
        <input type="email" name="email" required>

        <label>Wachtwoord:</label>
        <input type="password" name="password" minlength="8" required>

        <button type="submit">Registreren</button>

    </form>

    <p>
        Heb je al een account?
        <a href="login.php">Inloggen</a>
    </p>

</body>

</html>