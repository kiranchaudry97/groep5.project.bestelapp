# 📦 Bestelapp – Laravel gebaseerde materiaalbeheer en bestelapplicatie voor Aquafin

*Bestelapp* is een intuïtieve Laravel 10-webapplicatie ontwikkeld door studenten van Groep 5 (Erasmushogeschool Brussel), waarmee *techniekers materialen kunnen bestellen, **admins voorraad beheren* en *bestellingen opgevolgd* kunnen worden.

---

## 🎯 Functionaliteiten

### 🧰 Voor Admins
- CRUD voor materialen en categorieën
- Realtime voorraadbeheer
- Bestellingen opvolgen en status wijzigen
- Statistieken over bestelstatussen
- Rolgebaseerde toegang via middleware

### 🛠 Voor Techniekers
- Materialen filteren en zoeken
- Materiaal toevoegen aan winkelmand
- Bestelling plaatsen met leverdatum en adres
- Vorige bestellingen bekijken 

---

### 🧰 Materiaalbeheer (Admin)

- Overzicht van alle materialen
- Categorie-filter en zoekfunctie
- Voorraad bijhouden per item
- CRUD-functionaliteit (aanmaken, wijzigen, verwijderen)
- Toevoegen van nieuwe categorieën

### 🛒 Winkelmand & Bestellen (Technieker)

- Materialen toevoegen aan winkelmand
- Automatische voorraadvermindering
- Validatie bij te weinig voorraad
- Leverdatum en leveradres opgeven
- Bestelling verzenden met bevestigingsmelding

### 📦 Bestellingen

- Technieker kan bestellingen raadplegen en annuleren (zolang in behandeling)
- Admin kan status aanpassen (in behandeling, verzonden, afgehandeld)
- Leverinformatie en materiaaloverzicht per bestelling zichtbaar

---

## 🗃 Datamodellen

| Model      | Velden                                  |
|------------|------------------------------------------|
| User     | naam, e-mail, wachtwoord, rol            |
| Material | naam, categorie, voorraad, beschrijving  |
| Order    | user_id, leverdatum, adres, status       |
| OrderItem| order_id, material_id, aantal            |
| Category | naam                                     |

---


## 📋 Gebruikte Technologieën

| Component           | Stack                           |
|--------------------|----------------------------------|
| Framework          | Laravel 10                       |
| Styling            | Tailwind CSS                     |
| Autorisatie        | Spatie Laravel Permission        |
| Frontend templating| Blade                            |
| Database           | MySQL / SQLite                   |
| Validatie          | Laravel Form Requests            |
| Beveiliging        | CSRF, bcrypt, middleware         |

---

## 📂 Mappenstructuur

![Beschrijving](https://github.com/kiranchaudry97/groep5.project.bestelapp/blob/7637011007421da999553358e723a9659f76c927/foto/stuctuur.jpg)


## 🧠 Rolstructuur

| Rol        | Mogelijkheden                                |
|------------|-----------------------------------------------|
| Admin      | Materiaalbeheer, bestellingen opvolgen        |
| Technieker | Materialen bekijken, bestellen, winkelmand    |

---

## 📈 Beheer
	•	Materiaalbeheer met naam, categorie, voorraad, beschrijving
	•	Nieuwe categorie toevoegen via formulier
	•	Categorieën normaliseren (unicodestandaard)

⸻

## 💡 Extra
	•	Leveradres wordt opgeslagen bij bestelling
	•	Admin kan bestellingstatus aanpassen
	•	Bestellingen filterbaar op status
	•	Technieker ziet eigen bestellingen & detail

## 👤 Testaccounts

Gebruik onderstaande testaccounts om in te loggen en de functionaliteiten van de applicatie te testen.

| Rol        | Gebruikersnaam (E-mail) | Wachtwoord |
|------------|--------------------------|------------|
| *Admin*  | admin@aquafin.be         | admin123   |
| *Technieker* | tech@aquafin.be      | tech123    |

## 🔒 Beveiliging

- Wachtwoord-hashing
- CSRF-bescherming
- Toegangscontrole via middleware en policies
- Validatie van invoer op controller-niveau


## 🧪 Voorbeeldcode

### ✅ Winkelmand toevoegen

```php
if ($aantal > $material->voorraad) {
  return back()->with('error', 'Niet genoeg voorraad beschikbaar.');
}

$material->voorraad -= $aantal;
$material->save();
```

## 🎯 Features

| Functionaliteit            | Ondersteund |
|----------------------------|-------------|
| Materialen bestellen       | ✅          |
| Winkelmand beheren         | ✅          |
| Bestellingen inzien        | ✅          |
| Rolgebaseerde toegang      | ✅          |
| Admin dashboard            | ✅          |
| Realtime voorraadcontrole  | ✅          |

## 🚀 Installatie

### Vereisten
- PHP 8.3+
- Composer
- MySQL / SQLite
- Node.js (voor assets - optioneel)

### Stappen

```bash
git clone https://github.com/kiranchaudry97/groep5.project.bestelapp.git
cd groep5.project.bestelapp
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## 🧠 Ontwikkelingsteam
	•	Projectnaam: Bestelapp
	•	Team: Groep 5
	•  Vak: Programming Project
	•	Academiejaar: 2024–2025
	•	School: Erasmushogeschool Brussel
	•	Opdrachtgever: Aquafin

## 👥 Teamleden
	•	Kiran Chaud-Ry
	•	Yazid El Yazghi
	•	Damian Viracocha
	•	Elion Rexhepi
	•	Sorena Mohammad Rafiei Nazari

## Gebruikte Bronnen
AI Assistants:
- GitHub Copilot voor code suggestions en debugging tijdens development
- ChatGPT voor Database 

---

## 📜 Licentie

MIT License – vrij aanpasbaar binnen educatieve context.

Dit project is ontwikkeld als onderdeel van een schoolopdracht aan de Hogeschool Erasmus, binnen het kader van het Groep 5 Project – BestelApp.
