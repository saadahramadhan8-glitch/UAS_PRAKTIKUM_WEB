<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeCrudView extends Command
{
    /**
     * Nama command artisan
     */
    protected $signature = 'make:crud-view {name}';

    /**
     * Deskripsi command
     */
    protected $description = 'Membuat folder dan file CRUD blade otomatis';

    /**
     * Execute command
     */
    public function handle()
    {
        // Nama folder
        $name = strtolower($this->argument('name'));

        // Path folder views
        $folderPath = resource_path("views/{$name}");

        // Buat folder jika belum ada
        if (!File::exists($folderPath)) {

            File::makeDirectory($folderPath, 0755, true);
        }

        // Daftar file CRUD
        $files = [
            'index.blade.php',
            'create.blade.php',
            'edit.blade.php',
            'show.blade.php',
        ];

        foreach ($files as $file) {

            $filePath = "{$folderPath}/{$file}";

            // Skip jika file sudah ada
            if (File::exists($filePath)) {

                $this->warn("File {$file} sudah ada.");

                continue;
            }

            // Isi default blade
            $content = "<h1>{$file}</h1>";

            File::put($filePath, $content);

            $this->info("File {$file} berhasil dibuat.");
        }

        $this->info("CRUD View {$name} berhasil dibuat.");

        return Command::SUCCESS;
    }
}