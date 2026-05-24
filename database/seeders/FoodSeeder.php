<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | MAKANAN TERSEDIA
        |--------------------------------------------------------------------------
        */

        Food::create([

            'user_id' => 2,

            'title' => 'Nasi Kotak Ayam',

            'description' => 'Nasi kotak sisa katering masih layak konsumsi',

            'quantity' => 10,

            'expired_at' => now()->addHours(5),

            'status' => 'tersedia',

            'address' => 'Jl. Moh. Yamin, Palu',

        ]);

        /*
        |--------------------------------------------------------------------------
        | MAKANAN TERSEDIA
        |--------------------------------------------------------------------------
        */

        Food::create([

            'user_id' => 2,

            'title' => 'Roti Donat',

            'description' => 'Donat bakery sisa hari ini',

            'quantity' => 15,

            'expired_at' => now()->addHours(3),

            'status' => 'tersedia',

            'address' => 'Jl. Diponegoro, Palu',

        ]);

        /*
        |--------------------------------------------------------------------------
        | MAKANAN HABIS
        |--------------------------------------------------------------------------
        */

        Food::create([

            'user_id' => 2,

            'title' => 'Nasi Goreng',

            'description' => 'Makanan siap ambil',

            'quantity' => 0,

            'expired_at' => now()->addHours(2),

            'status' => 'habis',

            'address' => 'Jl. Setia Budi, Palu',

        ]);
    }
}