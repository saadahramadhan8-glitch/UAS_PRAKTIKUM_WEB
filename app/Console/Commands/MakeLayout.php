<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeLayout extends Command
{
    /**
     * Nama command artisan
     */
    protected $signature = 'make:layout {name}';

    /**
     * Deskripsi command
     */
    protected $description = 'Membuat layout blade otomatis';

    /**
     * Execute command
     */
    public function handle()
    {
        // Nama layout
        $name = strtolower($this->argument('name'));

        // Folder layouts
        $folderPath = resource_path('views/layouts');

        // File path
        $filePath = $folderPath . '/' . $name . '.blade.php';

        // Buat folder jika belum ada
        if (!File::exists($folderPath)) {

            File::makeDirectory($folderPath, 0755, true);
        }

        // Cek file sudah ada
        if (File::exists($filePath)) {

            $this->error("Layout {$name} sudah ada.");

            return Command::FAILURE;
        }

        // Template layout default
        $content = <<<BLADE
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ \$title ?? 'Dashboard' }}</title>

</head>
<body>

    {{ \$slot }}

</body>
</html>
BLADE;

        // Buat file
        File::put($filePath, $content);

        $this->info("Layout {$name} berhasil dibuat.");

        return Command::SUCCESS;
    }
}