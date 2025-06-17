
# 📦 Bestelapp – Laravel gebaseerde materiaalbeheer en bestelapplicatie

**Bestelapp** is een intuïtieve Laravel 10-webapplicatie waarmee techniekers materialen kunnen bestellen, voorraad kan worden beheerd en bestellingen nauwkeurig opgevolgd kunnen worden.  

De app is gebouwd met moderne webtechnologieën en volgt best practices op vlak van authenticatie, autorisatie, validatie en voorraadbeheer.

---

## 📚 Documentatie

De Bestelapp bevat gestructureerde routes, onderverdeeld per rol:

- `/technieker/materials`: toon beschikbare materialen
- `/technieker/cart`: beheer winkelmand
- `/technieker/orders`: overzicht van geplaatste bestellingen
- `/admin/materials`: beheer van materialen
- `/admin/bestellingen`: opvolging van alle bestellingen



---

## ⚙️ Efficiënt en robuust

De applicatie ondersteunt:

- **Sessiegebaseerd winkelmandbeheer**
- **Directe voorraadupdates bij bestelling**
- **Rollback van voorraad bij annulatie**
- **Rollenbeheer met [Spatie Laravel-permission](https://spatie.be/docs/laravel-permission)**
- **Responsieve UI via TailwindCSS**

Bestelapp verwerkt bestellingen met robuuste foutafhandeling, validatie en herbruikbare Blade-componenten.

---

## 💡 Gebruik

### Winkelmand toevoegen

```php
$request->validate([
  'material_id' => 'required|exists:materials,id',
  'aantal' => 'required|integer|min:1',
]);

$material = Material::findOrFail($request->material_id);

if ($aantal > $material->voorraad) {
  return back()->with('error', 'Niet genoeg voorraad beschikbaar.');
}

$material->voorraad -= $aantal;
$material->save();
```

### Bestelling opslaan

```php
$order = Order::create([
  'user_id' => auth()->id(),
  'leverdatum' => $request->leverdatum,
  'status' => 'in_behandeling',
]);

foreach ($cart as $materialId => $aantal) {
  OrderItem::create([
    'order_id' => $order->id,
    'material_id' => $materialId,
    'aantal' => $aantal,
  ]);
}
```

---

## 🎯 Features

| Functionaliteit            | Ondersteund |
|----------------------------|-------------|
| Materialen bestellen       | ✅          |
| Winkelmand beheren         | ✅          |
| Bestellingen inzien        | ✅          |
| Rolgebaseerde toegang      | ✅          |
| Admin dashboard            | ✅          |
| Realtime voorraadcontrole  | ✅          |

---

## 📦 Installatie

```bash
git clone https://github.com/kiranchaudry97/groep5.project.bestelapp.git
cd groep5.project.bestelapp
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Toegang: [http://localhost:8000](http://localhost:8000)

---

## 🔐 Testaccounts

| Rol        | Email                 | Wachtwoord |
|------------|------------------------|------------|
| Admin      | admin@example.com      | password   |
| Technieker | technieker@example.com | password   |

---

## 📂 Structuur

- `routes/web.php`: gesegmenteerde routing
- `app/Models`: Eloquent modellen zoals `Material`, `Order`
- `app/Http/Controllers/Admin`: Adminlogica
- `app/Http/Controllers/Technieker`: Techniekerlogica
- `resources/views/`: UI views in Blade

---

## 🔒 Beveiliging

- Wachtwoord-hashing
- CSRF-bescherming
- Toegangscontrole via middleware en policies
- Validatie van invoer op controller-niveau

---

## 🧪 Testen

Testbare onderdelen zoals:
- Voorraadverificatie
- Bestelbevestiging
- Rolvalidatie

```bash
php artisan test
```

---

## 📦 Releases

Gebruik GitHub Tags voor versiebeheer:

```bash
git tag v1.0.0
git push origin v1.0.0
```

---

## 🧠 Ontwikkelingsteam

- **Projectnaam**: Bestelapp
- **Team**: Groep 5
- **Teamleden**: Kiran Chaudry, Sorena, Yazid, Damian, Elion
- **Academiejaar**: 2024–2025
- **School**: Erasmushogeschool Brussel

---

## 📜 Licentie

MIT License – open source en vrij aanpasbaar binnen educatieve context.


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
