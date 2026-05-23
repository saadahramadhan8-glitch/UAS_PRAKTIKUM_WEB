<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'claims';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'food_id',
        'user_id',
        'status',
        'claim_date',
        'notes'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    // Claim milik satu makanan
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    // Claim milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Claim memiliki satu delivery
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPE
    |--------------------------------------------------------------------------
    */

    // Claim pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Claim disetujui
    public function scopeApproved($query)
    {
        return $query->where('status', 'disetujui');
    }

    // Claim selesai
    public function scopeCompleted($query)
    {
        return $query->where('status', 'selesai');
    }
}