
# 📦 Bestelapp – Laravel gebaseerde materiaalbeheer en bestelapplicatie

<<<<<<< HEAD
<<<<<<< HEAD
**Bestelapp** is een intuïtieve Laravel 10-webapplicatie waarmee techniekers materialen kunnen bestellen, voorraad kan worden beheerd en bestellingen nauwkeurig opgevolgd kunnen worden.  
=======
**Bestelapp** Voor bedrijf Aquafin aangemaakt op een intuïtieve Laravel 10-webapplicatie waarmee techniekers materialen kunnen bestellen, voorraad kan worden beheerd en bestellingen nauwkeurig opgevolgd kunnen worden.  
>>>>>>> ef7a0551928ba70593feea0bcede9bfe45ae908a
=======
**Bestelapp** Voor bedrijf Aquafin aangemaakt op een  Laravel 10-webapplicatie waarmee techniekers materialen kunnen bestellen, voorraad kan worden beheerd worden en bestellingen opgevolgd kunnen worden.  
>>>>>>> e5ddf02b73af5892cdc9c7fb6dbdde15ac759650

De app is gebouwd met moderne webtechnologieën en volgt best practices op vlak van authenticatie, autorisatie, validatie en voorraadbeheer.

---

## 📚 Documentatie

<<<<<<< HEAD
De Bestelapp bevat gestructureerde RESTful routes, onderverdeeld per rol:
=======
De Bestelapp bevat gestructureerde routes, onderverdeeld per rol:
>>>>>>> ef7a0551928ba70593feea0bcede9bfe45ae908a

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
| Admin      | admin@aquafin.be      | admin123   |
| Technieker | tech@aquafin.be | tech123   |

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
<<<<<<< HEAD

Gebruik GitHub Tags voor versiebeheer:
=======

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

>>>>>>> ef7a0551928ba70593feea0bcede9bfe45ae908a

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
