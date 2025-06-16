
# 🛒 BestelApp – Materiaalbeheer voor techniekers

Een webapplicatie in Laravel waarmee techniekers van Aquafin materiaal kunnen bestellen en opvolgen voor herstellingen en onderhoudswerken.

🔗 **Repository**: [https://github.com/kiranchaudry97/groep5.project.bestelapp](https://github.com/kiranchaudry97/groep5.project.bestelapp)

---

## 📁 Projectstructuur

```text
groep5.project.bestelapp/
│
├── app/                    # Models, Controllers, Services
├── bootstrap/              # Laravel bootstrap-bestanden
├── config/                 # Configuratiebestanden
├── database/               # Migraties, seeders, factories
├── public/                 # Publieke webroot
├── resources/              # Views (Blade), CSS, JS
├── routes/                 # Web.php en API-routes
├── storage/                # Logs, cache en uploads
├── tests/                  # PHPUnit testbestanden
├── vite.config.js          # Vite configuratiebestand
├── tailwind.config.js      # Tailwind CSS configuratie
├── package.json            # Node.js dependencies en scripts
└── .env                    # Omgevingsvariabelen (niet committen)
```

---

## 📦 package.json

```json
{
  "private": true,
  "scripts": {
    "dev": "vite",
    "build": "vite build"
  },
  "devDependencies": {
    "autoprefixer": "^10.4.2",
    "laravel-vite-plugin": "^0.7.2",
    "postcss": "^8.4.6",
    "tailwindcss": "^3.0.23",
    "vite": "^4.0.0"
  }
}
```

- `vite`: bundelt CSS en JS
- `tailwindcss`: utility-first CSS
- `laravel-vite-plugin`: koppelt Vite aan Laravel

---

## 🧭 Overzicht

De applicatie biedt:
- ✅ Bestelpagina voor techniekers
- ✅ Adminbeheer van materiaal
- ✅ Leverdatum toevoegen
- ✅ Historiek van bestellingen

---

## ✅ Functionaliteiten

- 🔐 Inloggen en registreren
- 🛒 Toevoegen aan winkelwagen
- 🗂️ Admin kan materiaal toevoegen, verwijderen
- 📅 Leverdatum instellen per bestelling

---

## 🖼️ Screenshots (in README.md plaatsen als je ze hebt)

📷 Homepagina  
📷 Winkelwagen  
📷 Dashboard  
📷 Bestellingsoverzicht

---

## ⚙️ Installatie

### Laravel backend
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

## 🗃️ Database & Relaties

📷 Voeg hier een ERD-afbeelding toe

Relaties:
- `User` ↔ `Orders` (1:N)
- `Order` ↔ `OrderItems` (1:N)
- `Product` ↔ `OrderItems` (1:N)

---

## 🧪 Testen

```bash
php artisan test
```

📷 Voeg hier een screenshot toe van testresultaten

---

## 🔒 Security

- Bcrypt hashing
- CSRF-bescherming
- Middleware voor admin routes
- Validatie via Form Requests

---

## 🧠 Code Uitleg (Overzicht)

### 🛒 Voorbeeld controller: Bestelling plaatsen
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'leverdatum' => 'required|date',
        'items' => 'required|array',
    ]);

    $order = Order::create([
        'user_id' => auth()->id(),
        'leverdatum' => $validated['leverdatum']
    ]);

    foreach ($validated['items'] as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'aantal' => $item['aantal']
        ]);
    }

    return redirect()->route('orders.index')->with('success', 'Bestelling geplaatst.');
}
```

- ✅ Valideert input
- ✅ Slaat de bestelling en items op
- ✅ Gebruikt Eloquent relaties

---

## 👨‍👩‍👧‍👦 Team

Graduaat Programmeren : Kiran Chaud-ry , Elion Rexhepi, Ellis Damian Viracocha, Yazid-El-Yazghi

---

## 📅 Trello

📷 Voeg hier een screenshot toe  
🔗 Voeg hier je Trello-link toe

---

## 📄 Licentie

MIT – vrij gebruik met bronvermelding.

---

