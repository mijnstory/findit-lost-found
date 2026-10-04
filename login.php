<?php
// Start een sessie zodat we kunnen onthouden wie is ingelogd
session_start();

// Haal de databaseverbinding op
require_once "config/database.php";

// Variabele voor meldingen
$message = "";

// Controleer of het formulier is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Haal de ingevulde gegevens op
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Controleer of beide velden zijn ingevuld
    if (empty($email) || empty($password)) {
        $message = "Vul alle velden in.";
    } else {

        // Zoek de gebruiker op via het e-mailadres
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Controleer of gebruiker bestaat en wachtwoord klopt
        if ($user && password_verify($password, $user["password"])) {

            // Sla gegevens van de ingelogde gebruiker op in de sessie
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["role"] = $user["role"];

            // Stuur gebruiker door naar het dashboard
            header("Location: dashboard.php");
            exit;

        } else {
            $message = "E-mailadres of wachtwoord is onjuist.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Inloggen - FindIt</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Inloggen</h1>

    <!-- Toon een melding als er iets fout gaat -->
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Loginformulier -->
    <form method="POST" action="">

        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" required>

        <br><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>

        <br><br>

        <button type="submit">Inloggen</button>

    </form>

    <p>
        Nog geen account?
        <a href="register.php">Registreren</a>
    </p>

</body>

</html>