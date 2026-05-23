<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delivery;

class DeliverySeeder extends Seeder
{
    public function run(): void
    {
        Delivery::create([
            'claim_id' => 1,
            'courier_id' => 4,
            'delivery_status' => 'completed',
            'delivery_date' => now(),
            'notes' => 'Makanan berhasil diantar',
        ]);
    }
}