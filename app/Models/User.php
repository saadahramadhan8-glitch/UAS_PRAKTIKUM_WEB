<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
    ];

    /**
     * Hidden Attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast Attributes
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // User memiliki banyak makanan
    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    // User memiliki banyak klaim
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    // User memiliki banyak notifikasi
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Kurir memiliki banyak pengiriman
    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'courier_id');
    }

}