# 📦 Bestelapp - Materiaalbeheer voor Techniekers

Een webapplicatie gebouwd voor Aquafinmet  **Laravel 10** waarmee techniekers eenvoudig materialen kunnen bestellen, admins voorraad kunnen beheren en beide rollen elk hun eigen dashboard hebben.

---

## Functionaliteiten

### Materiaal bestellen (technieker)

1. Ga naar het materiaaloverzicht: `/technieker/materials`
2. Filter per categorie of zoek op naam
3. Kies een hoeveelheid en voeg toe aan winkelmand
4. Voorraad wordt automatisch gecontroleerd
5. Bestelling wordt bijgehouden in een sessie
6. Ga naar winkelmand → kies leverdatum → bevestig bestelling
7. Voorraad wordt automatisch verminderd

#### Voorbeeld formulier in Blade:

blade
<form method="POST" action="{{ route('technieker.cart.add') }}">
  @csrf
  <input type="hidden" name="material_id" value="{{ $material->id }}">
  <input type="number" name="aantal" max="{{ $material->voorraad }}" required>
  <button type="submit">Toevoegen</button>
</form>


## Rollen en toegang

### Admin
1. Materialen aanmaken, bewerken en verwijderen
2. Techniekeraccounts beheren.
3. Bestellingen opvolgen en statussen aanpassen

### Techniekers
1. Materialen bekijken en filteren
2. Toevoegen aan winkelmand
3. Bestellingen indienen & annuleren
4. Bestelgeschiedenis bekijken

#### Technische Stack:
1. Laravel 10 
2. Laravel Breeze (voor authenticatie)
3. Spatie Laravel-permission (voor rolbeheer)
4. TailwindCSS (frontend)
5. Blade templates
6. PHP 8.2+
7. MySQL of SQLite



## Installatie

1. Clone de repository
git clone https://github.com/kiranchaudry97/groep5.project.bestelapp.git
cd groep5.project.bestelapp

2.  Installeer dependencies
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate

3.  Configureer .env
DB_CONNECTION=mysql
DB_DATABASE=bestelapp
DB_USERNAME=root
DB_PASSWORD=

4. Database migreren + seed
php artisan migrate --seed

5. Start de server
php artisan 
serve

toegang :  http://localhost:8000

## Testgebruikers
   Rol	        E-mail	Wachtwoord
1. Admin	admin@example.com	password
2. Technieker	technieker@example.com	password

## Belangrijke Bestanden & Structuur
| Bestand/Map                       | Omschrijving                            |
| --------------------------------- | --------------------------------------- |
| `routes/web.php`                  | Webroutes met aparte groepen per rol    |
| `app/Http/Controllers/Admin`      | Admin controllers                       |
| `app/Http/Controllers/Technieker` | Technieker controllers                  |
| `database/seeders`                | Seeder voor voorbeelddata               |
| `resources/views/technieker`      | Views voor technieker (bestellen, cart) |
| `resources/views/admin`           | Admin dashboard en beheer               |



## Screenshots

## Team & Projectinformatie

| Info         | Inhoud                                      |
| ------------ | ------------------------------------------- |
| Team         | Groep 5                                     |
| Leden        | Kiran Chaudry, Sorena, Yazid, Damian, Elion |
| School       | Erasmushogeschool Brussel                   |
| Academiejaar | 2024–2025                                   |
| Project      | Programming Project                         |



## Team & Projectinformatie

1. Laravel Documentation

2. Spatie Laravel-Permission

3. TailwindCSS

4. GitHub Copilot

5. ChatGPT
About
project aquafin

Resources
 Readme
 Activity
Stars
 0 stars
Watchers
 0 watching
Forks
 0 forks
Releases
No releases published
Create a new release
Packages
No packages published
Publish your first package
Contributors
5
@kiranchaudry97
@Damiansjj
@Elion05
@SorenaRafiei01
@Yazid-El-Yazghi
Languages
Blade
58.4%
 
PHP
41.4%
 
Other
0.2%
Suggested workflows
Based on your tech stack
Laravel logo
Laravel
Test a Laravel project.
SLSA Generic generator logo
SLSA Generic generator
Generate SLSA3 provenance for your existing release workflows
Webpack logo
Webpack
Build a NodeJS project with npm and webpack.
More workflows
Footer
