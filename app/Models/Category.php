<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

class Category extends Model
{
    use HasFactory;

    /**
     * Tabelnaam (optioneel, indien anders dan 'categories')
     */
    // protected $table = 'categories';

    /**
     * Mass assignable attributen.
     */
    protected $fillable = [
        'naam',
    ];

    /**
     * Relatie: een categorie heeft meerdere materialen.
     */
    public function materials()
    {
        return $this->hasMany(Material::class, 'category_id');
    }
}