<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Mass assignment toestaan voor deze velden.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'leverdatum',
    ];

    /**
     * Relatie met de gebruiker (besteller).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relatie met order items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}