<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Penyedia 1',
            'email' => 'penyedia1@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'penyedia',
        ]);

        User::create([
            'name' => 'Penyedia 2',
            'email' => 'penyedia2@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'penyedia',
        ]);

        User::create([
            'name' => 'Penerima 1',
            'email' => 'penerima1@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'penerima',
        ]);

        User::create([
            'name' => 'Kurir 1',
            'email' => 'kurir1@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'kurir',
        ]);
    }
}