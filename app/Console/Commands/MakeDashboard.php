<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDashboard extends Command
{
    /**
     * Nama command artisan
     */
    protected $signature = 'make:dashboard {name}';

    /**
     * Deskripsi command
     */
    protected $description = 'Membuat dashboard blade otomatis';

    /**
     * Execute command
     */
    public function handle()
    {
        // Ambil nama dashboard
        $name = strtolower($this->argument('name'));

        // Lokasi folder dashboard
        $folderPath = resource_path('views/dashboard');

        // Lokasi file blade
        $filePath = $folderPath . '/' . $name . '.blade.php';

        // Buat folder jika belum ada
        if (!File::exists($folderPath)) {

            File::makeDirectory($folderPath, 0755, true);
        }

        // Cek apakah file sudah ada
        if (File::exists($filePath)) {

            $this->error("Dashboard {$name} sudah ada.");

            return Command::FAILURE;
        }

        // Isi template blade
        $content = <<<BLADE
<h1>Dashboard {$name}</h1>

<p>Selamat datang di dashboard {$name}</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit">
        Logout
    </button>
</form>
BLADE;

        // Buat file blade
        File::put($filePath, $content);

        $this->info("Dashboard {$name} berhasil dibuat.");

        return Command::SUCCESS;
    }
}