
-- Tabel voor gebruikers
CREATE TABLE users (
    -- Uniek nummer voor iedere gebruiker
    id INT AUTO_INCREMENT PRIMARY KEY,

    -- Naam van de gebruiker
    name VARCHAR(100) NOT NULL,

    -- E-mailadres moet uniek zijn
    email VARCHAR(150) NOT NULL UNIQUE,

    -- Hier wordt het gehashte wachtwoord opgeslagen
    password VARCHAR(255) NOT NULL,

    -- Rol van de gebruiker, standaard is dit een melder
    role VARCHAR(20) NOT NULL DEFAULT 'melder'
);

-- Tabel voor verloren voorwerpen
CREATE TABLE lost_items (
    -- Uniek nummer voor iedere verliesmelding
    id INT AUTO_INCREMENT PRIMARY KEY,

    -- Verwijst naar de gebruiker die de melding heeft gemaakt
    user_id INT NOT NULL,

    -- Titel van het verloren voorwerp
    title VARCHAR(150) NOT NULL,

    -- Categorie van het voorwerp
    category VARCHAR(100) NOT NULL,

    -- Beschrijving van het voorwerp
    description TEXT NOT NULL,

    -- Locatie waar het voorwerp verloren is
    location VARCHAR(150) NOT NULL,

    -- Datum waarop het voorwerp verloren is
    lost_date DATE NOT NULL,

    -- Verborgen kenmerk waarmee eigenaarschap gecontroleerd kan worden
    secret_feature VARCHAR(255),

    -- Status van de melding
    status VARCHAR(50) NOT NULL DEFAULT 'open',

    -- Datum en tijd waarop de melding is aangemaakt
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Koppeling met de users tabel
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Tabel voor gevonden voorwerpen
CREATE TABLE found_items (
    -- Uniek nummer voor ieder gevonden voorwerp
    id INT AUTO_INCREMENT PRIMARY KEY,

    -- Verwijst naar de gebruiker of medewerker die het voorwerp registreert
    user_id INT NOT NULL,

    -- Titel van het gevonden voorwerp
    title VARCHAR(150) NOT NULL,

    -- Categorie van het voorwerp
    category VARCHAR(100) NOT NULL,

    -- Beschrijving van het voorwerp
    description TEXT NOT NULL,

    -- Locatie waar het voorwerp gevonden is
    location VARCHAR(150) NOT NULL,

    -- Datum waarop het voorwerp gevonden is
    found_date DATE NOT NULL,

    -- Status van het gevonden voorwerp
    status VARCHAR(50) NOT NULL DEFAULT 'open',

    -- Datum en tijd waarop het voorwerp is geregistreerd
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- koppeling met de users tabel --
    FOREIGN KEY (user_id) REFERENCES users(id)
);