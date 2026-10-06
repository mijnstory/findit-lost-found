# FindIt Lost & Found

FindIt is een eenvoudige webapplicatie voor het melden en beheren van verloren en gevonden voorwerpen.

## Gebruikte technieken

- PHP
- HTML
- CSS
- MySQL
- XAMPP
- GitHub
- Plesk

## Functies

- Registreren
- Inloggen
- Uitloggen
- Verloren voorwerp melden
- Eigen verliesmeldingen bekijken
- Gevonden voorwerp registreren
- Gevonden voorwerpen bekijken
- Status wijzigen
- Rollen: melder en medewerker

## Installatie

1. Plaats het project in:

```text
C:\xampp\htdocs\findit-lost-found
2. Start Apache en MySQL in XAMPP.
3. Open phpMyAdmin.
4. Importeer database.sql.
5. Open de applicatie via:
http://localhost/findit-lost-found/

Database
De applicatie gebruikt drie tabellen:
- users
- lost_items
- found_items
Beveiliging
- Wachtwoorden worden opgeslagen met password_hash().
- Bij het inloggen wordt password_verify() gebruikt.
- Databasequery's gebruiken prepared statements.
- Pagina's controleren of een gebruiker is ingelogd.
- Alleen medewerkers kunnen bepaalde functies gebruiken.
- Gegevens die op het scherm worden getoond gebruiken htmlspecialchars().
Koppeling realisatie
Functie	Eis	Ontwerp	Planning
Registreren	Gebruiker kan een account aanmaken	Registratiescherm en users tabel	Registratie bouwen
Inloggen	Gebruiker kan veilig inloggen	Loginscherm, sessies en users tabel	Login en dashboard bouwen
Verloren voorwerp melden	Gebruiker kan een verloren voorwerp melden	Meldformulier en lost_items tabel	Verliesmelding bouwen
Mijn verliesmeldingen	Gebruiker ziet eigen verliesmeldingen	Overzichtsscherm en filtering op user_id	Overzicht eigen meldingen bouwen
Gevonden voorwerp registreren	Medewerker kan een gevonden voorwerp registreren	Meldformulier en found_items tabel	Gevonden melding bouwen
Gevonden voorwerpen bekijken	Gebruikers kunnen gevonden voorwerpen bekijken	Overzichtsscherm found_items	Overzicht gevonden voorwerpen bouwen
Status wijzigen	Medewerker kan de status aanpassen	Statusveld in database en wijzigscherm	Statusfunctie bouwen
Rollen	Alleen medewerkers hebben toegang tot bepaalde functies	role veld in users en sessiecontrole	Autorisatie toevoegen


Verschillen tussen ontwerp en eindproduct
Tijdens de ontwikkeling is de applicatie bewust eenvoudig gehouden zodat de belangrijkste functies binnen de beschikbare tijd goed konden worden gerealiseerd.
De belangrijkste functies uit het ontwerp zijn gebouwd.
Een uitgebreide automatische matchingfunctie tussen verloren en gevonden voorwerpen is niet gebouwd. In plaats daarvan kan een medewerker de status van een voorwerp aanpassen naar match gevonden.
De applicatie gebruikt een eenvoudige PHP-structuur zonder framework. Hierdoor blijft de code overzichtelijk en goed te onderhouden.
Online versie
https://findit.s2171408.jouw.website
GitHub
https://github.com/mijnstory/findit-lost-found
De definitieve versie staat op de main branch.