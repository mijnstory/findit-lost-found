# FindIt Lost & Found

FindIt is een eenvoudige webapplicatie voor het melden en beheren van verloren en gevonden voorwerpen.

## Gebruikte technieken

- PHP
- HTML
- CSS
- MySQL
- XAMPP
- GitHub

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


## Koppeling eisen en functies

| Functie | Eis / doel |
|---|---|
| Registreren | Een gebruiker kan een account aanmaken |
| Inloggen | Een gebruiker kan veilig inloggen |
| Verloren voorwerp melden | Een melder kan een verliesmelding maken |
| Mijn verliesmeldingen | Een gebruiker ziet zijn eigen meldingen |
| Gevonden voorwerp registreren | Een medewerker kan een gevonden voorwerp toevoegen |
| Gevonden voorwerpen bekijken | Gebruikers kunnen gevonden voorwerpen bekijken |
| Status wijzigen | Een medewerker kan de status aanpassen |
| Rollen | Medewerkerfuncties zijn beveiligd tegen gewone gebruikers |

## Verschillen tussen ontwerp en eindproduct

Tijdens de ontwikkeling is de applicatie bewust eenvoudig gehouden zodat de belangrijkste functies binnen de beschikbare tijd goed konden worden gerealiseerd.

De belangrijkste functies uit het ontwerp zijn gebouwd.

Een uitgebreide automatische matchingfunctie tussen verloren en gevonden voorwerpen is niet gebouwd. In plaats daarvan kan een medewerker de status van een voorwerp aanpassen naar "match gevonden".

De applicatie gebruikt een eenvoudige PHP-structuur zonder framework. Hierdoor blijft de code overzichtelijk en goed te onderhouden.