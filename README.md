
# 🛒 BestelApp – Materiaalbeheer voor Techniekers (Aquafin)

Een Laravel-webapplicatie waarmee techniekers van Aquafin materiaal kunnen raadplegen, bestellen en opvolgen. Admins beheren het aanbod en gebruikers. Alles is beveiligd, getest en gestructureerd met duidelijke documentatie en design.

🔗 **Repository**: [https://github.com/kiranchaudry97/groep5.project.bestelapp](https://github.com/kiranchaudry97/groep5.project.bestelapp)

---

## 📁 Mappenstructuur

```text
groep5.project.bestelapp/
├── app/                  # Controllers, Models
├── resources/            # Blade views, CSS, JS
├── routes/               # web.php, api.php
├── database/             # Migraties, seeders
├── public/               # Publieke toegang, index.php
├── config/               # Laravel-configuratie
├── tests/                # PHPUnit tests
├── package.json          # Frontend dependencies
├── vite.config.js        # Vite configuratie
└── .env                  # Omgevingsinstellingen
```

---

## 📦 `package.json` uitleg

- `vite`: compileert assets
- `tailwindcss`: zorgt voor styling
- `laravel-vite-plugin`: koppelt dit aan Laravel views

---

## 📌 Projectdoel

Techniekers van Aquafin moeten dagelijks kunnen rekenen op materiaal. Deze app laat hen bestellingen plaatsen met leverdatum. Admins beheren materialen, voorraden en rollen.

---

## ✅ Functionaliteiten

- Gebruikersregistratie en login
- Materiaal raadplegen en bestellen
- Leverdatum instellen
- Rollen en rechten beheren
- Admin- en gebruikersdashboards

---

## 🧭 Flowchart van de applicatie

📷 *Functioneel overzicht van de gebruikersstroom:*

![Flowchart](bestel_app_flowchart.jpeg)

---

## 🎨 Moodboard & Designstijl

📷 *UI-kleuren, lettertypes, knoppen, pictogrammen*

![Moodboard](bestel_app_moodboard.jpeg)

---

## 🖼️ Screenshots van de applicatie

### 👤 Admin Login & Dashboard
![Admin dashboard](admin-dashboard.jpg)

### 🛠️ Materiaalbeheer
![Materiaalbeheer](admin-materiaal-beheer.jpg)

### ✏️ Materiaal Bewerken
![Materiaal Bewerken](admin-materiaal-bewerken.jpg)

### ➕ Materiaal Toevoegen
![Materiaal Toevoegen](admin-materiaal-toevoegen.jpg)

### 👷 Technieker Dashboard
![Gebruiker dashboard](gebruiker-dashboard.jpg)

### 🛒 Besteloverzicht (technieker)
![Bestelling Detail](gebruiker-bestellingen-bestelnummer.jpg)

### 📦 Materiaal Selectie & Filtering
![Materiaal overzicht](gebruiker-materiaal-overzicht.jpg)

### 👤 Profielpagina
![Profielpagina](gebruiker-profiel.jpg)

---

## 🧪 Prototypeschermen

📷 *Volledig klikbare mockups*

![Prototype overzicht](bestel_app_prototype.jpg)

---

## ⚙️ Installatie

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Frontend (Vite)
```bash
npm install
npm run dev
```

---

## 🗃️ Database & ERD

📷 *ERD-datamodel: gebruikers, rollen, materialen, bestellingen*

![ERD](2af6824c-be7f-4496-a6db-b6335eb6ae43.jpg)

Relaties:
- `gebruikers` ↔ `bestellingen`
- `bestellingen` ↔ `bestelregels` ↔ `materialen`
- `gebruikers` ↔ `rollen` ↔ `rechten`

---

## 🧪 Testen

```bash
php artisan test
```

- Bestelling plaatsen
- Validatiecontrole
- Rechtenbeheer

---

## 🔒 Beveiliging

- CSRF-beveiliging op formulieren
- Validatie via Form Requests
- Rollen- en rechtenbeheer via middleware
- Bcrypt hashing voor wachtwoorden

---

## 🧠 Codevoorbeeld – Bestelling plaatsen

```php
public function store(Request $request) {
  $data = $request->validate([
    'leverdatum' => 'required|date',
    'items' => 'required|array'
  ]);
  $bestelling = Bestelling::create([
    'gebruiker_id' => auth()->id(),
    'leverdatum' => $data['leverdatum'],
  ]);
  foreach ($data['items'] as $item) {
    Bestelregel::create([
      'bestelling_id' => $bestelling->id,
      'materiaal_id' => $item['materiaal_id'],
      'hoeveelheid' => $item['aantal'],
      'prijs' => $item['prijs']
    ]);
  }
  return redirect()->route('bestellingen.index');
}
```

---

## 👥 Team

Graduaat Programmeren : Kiran Chaud-ry , Elion Rexhepi, Ellis Damian Viracocha, Yazid-El-Yazghi


---

## 📅 Roadmap / Trello

🔗 Voeg hier je Trello-link toe  
📷 Voeg een screenshot toe van het sprintbord

---

## 📄 Licentie

MIT – Vrij te gebruiken, aanpassen en delen met bronvermelding.
