<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'deliveries';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'claim_id',
        'courier_id',
        'delivery_status',
        'delivery_date',
        'notes'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    // Delivery milik satu claim
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    // Delivery dimiliki kurir
    public function courier()
    {
        return $this->belongsTo(User::class, 'courier_id');
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPE
    |--------------------------------------------------------------------------
    */

    // Delivery pending
    public function scopePending($query)
    {
        return $query->where('delivery_status', 'pending');
    }

    // Delivery sedang diantar
    public function scopeDelivering($query)
    {
        return $query->where('delivery_status', 'delivering');
    }

    // Delivery selesai
    public function scopeCompleted($query)
    {
        return $query->where('delivery_status', 'completed');
    }
}