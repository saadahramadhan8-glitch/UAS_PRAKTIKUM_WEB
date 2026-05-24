<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'quantity',
        'expired_at',
        'image',
        'status',
        'latitude',
        'longitude',
        'address'
    ];

    // RELATION
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function claim()
    {
        return $this->hasOne(Claim::class);
    }

    // QUERY SCOPE

    public function scopeAvailable($query)
    {
        return $query->where('status', 'tersedia');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending_verification');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'kadaluarsa');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}