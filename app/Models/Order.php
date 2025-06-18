<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * Mass assignment: sta deze velden toe.
     */
    protected $fillable = [
        'user_id',
        'status',
        'leverdatum',
        'adres', // ✅ leveradres inbegrepen
    ];

    /**
     * Een bestelling hoort bij een gebruiker.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Een bestelling heeft meerdere items.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}