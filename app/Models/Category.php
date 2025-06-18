<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

class Category extends Model
{
    use HasFactory;

    // protected $table = 'categories'; // ← niet nodig tenzij je een andere tabelnaam gebruikt

    protected $fillable = [
        'naam', // ← zorgt ervoor dat je via create([]) veilig kan opslaan
    ];

    public function materials()
    {
        return $this->hasMany(Material::class, 'category_id'); // ← correcte relatie
    }
}