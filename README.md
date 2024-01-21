# Projekt IIS

## Autoři
- Adam Světlík
- Lukáš Zavadil
- David Sklenář

## URL aplikace
- [https://idriveis-a08abe0e1ef2.herokuapp.com/](https://idriveis-a08abe0e1ef2.herokuapp.com/) - již nefunguje, ukončeno 19.12.2023, hosting nebyl nadále potřeba protože projekt byl již ohodnocen

### Video

- [https://youtu.be/97lCBteGAvo](https://youtu.be/97lCBteGAvo)

## Implementace

Backend naší aplikace je napsaný v jazyce PHP za použití frameworku Laravel a skládá se z modelů a repozitářů. Modely reprezentují jednotlivé tabulky v databázi a repozitáře obsahují funkce, které nad modely volají SQL dotazy a příkazy. Frontend je napsaný v jazyce Javascript za použití frameworků Vue a Vuetify, každý .vue soubor je vložen do souboru Base.vue a reprezentuje jednu obrazovku uživatelského rozhraní. Komunikaci mezi frontendem a backendem zajišťují Controllery. Pro každý repozitář existuje Controller, který se stará o aktualizaci zobrazovaných dat na základě interakce uživatele s aplikací a to pomocí API, v rámci které se volají pro jednotlivé endpointy příslušné Controllery. Vue pohledy jsou pak propojeny s urls jednotlivých obrazovek a volají potřebné API endpointy.

### Databáze

![Schéma relační databáze](resources/images/db.png)

## Instalace

**Softwarové požadavky**

- PHP 8.1
- Composer 2.6.5
- Node.js 20.9.0
- npm 10.1.0
- Laravel Installer 5.1.3
- Laravel Framework 10.32.1


**Spuštění aplikace v development režimu**

- Stáhnout soubory projektu
- Spustit příkaz `composer install`
- Spustit příkaz `npm install`
- Spustit příkaz `npm run dev`
- Spustit příkaz `php artisan serve`