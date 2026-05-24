<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeView extends Command
{
    /**
     * Nama command
     */
    protected $signature = 'make:view {name}';

    /**
     * Deskripsi
     */
    protected $description = 'Membuat file blade view otomatis';

    /**
     * Execute command
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Path file blade
        $path = resource_path(
            'views/' . str_replace('.', '/', $name) . '.blade.php'
        );

        // Folder parent
        $directory = dirname($path);

        // Buat folder jika belum ada
        if (!File::exists($directory)) {

            File::makeDirectory($directory, 0755, true);
        }

        // Cek file sudah ada
        if (File::exists($path)) {

            $this->error("View sudah ada.");

            return Command::FAILURE;
        }

        // Isi default blade
        $content = <<<BLADE
@extends('layouts.dashboard')

@section('content')



@endsection
BLADE;

        // Buat file
        File::put($path, $content);

        $this->info("View berhasil dibuat: {$name}");

        return Command::SUCCESS;
    }
}