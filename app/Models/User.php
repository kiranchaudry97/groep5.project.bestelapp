<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * De velden die massaal ingevuld mogen worden.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Velden die verborgen moeten zijn bij serialisatie (bv. JSON).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Type-conversies voor attributen.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ✅ Custom e-mail router voor notificaties.
     * Gebruik een alternatief e-mailadres voor specifieke accounts.
     */
    public function routeNotificationForMail(): string
    {
        // Als het gaat om het testaccount, stuur mail naar dev/test-adres
        if ($this->email === 'tech@aquafin.be') {
            return 'kiran.chaudry@outlook.be';
        }

        return $this->email;
    }
}