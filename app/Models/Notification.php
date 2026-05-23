<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'notifications';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'is_read'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    // Notification milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPE
    |--------------------------------------------------------------------------
    */

    // Notification belum dibaca
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Notification sudah dibaca
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }
}