<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    /**
     * Mass assignable fields
     */
    protected $fillable = [

        // relasi makanan
        'food_id',

        // user penerima
        'user_id',

        // jumlah claim
        'quantity',

        // status claim
        'status',

        // tanggal claim
        'claim_date',

        // catatan tambahan
        'notes'

    ];

    /**
     * Relasi ke makanan
     */
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    /**
     * Relasi ke user penerima
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}