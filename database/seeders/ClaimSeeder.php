<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Claim;

class ClaimSeeder extends Seeder
{
    public function run(): void
    {
        Claim::create([
            'food_id' => 3,
            'user_id' => 3,
            'status' => 'disetujui',
            'claim_date' => now(),
            'notes' => 'Akan diambil sore hari',
        ]);
    }
}