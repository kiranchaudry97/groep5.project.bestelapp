<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'naam',
        'categorie',
        'voorraad',
    ];

    /**
     * Relatie met order items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Zoek dubbele materialen op basis van naam.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function findDuplicates()
    {
        return self::select('naam')
            ->groupBy('naam')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('naam');
    }

    /**
     * Verwijder dubbele materialen op basis van naam.
     *
     * Houdt telkens één materiaal met dezelfde naam, en verwijdert de rest.
     */
    public static function removeDuplicates()
    {
        $names = self::findDuplicates();

        foreach ($names as $naam) {
            $duplicates = self::where('naam', $naam)->get();

            // Houd de eerste, verwijder de rest
            $duplicates->shift();

            foreach ($duplicates as $duplicate) {
                $duplicate->delete();
            }
        }

        return count($names);
    }
}