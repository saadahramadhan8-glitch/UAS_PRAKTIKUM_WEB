<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('foods', function (Blueprint $table) {

            // PRIMARY KEY
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELATION
            |--------------------------------------------------------------------------
            */

            // Relasi ke users
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | FOOD INFORMATION
            |--------------------------------------------------------------------------
            */

            // Judul makanan
            $table->string('title');

            // Deskripsi makanan
            $table->text('description');

            // Jumlah makanan
            $table->integer('quantity');

            // Batas waktu konsumsi
            $table->dateTime('expired_at');

            // Gambar makanan
            $table->string('image')->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS MAKANAN
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'pending_verification',
                'tersedia',
                'diklaim',
                'diproses',
                'diantar',
                'selesai',
                'kadaluarsa'
            ])->default('pending_verification');

            /*
            |--------------------------------------------------------------------------
            | LOCATION
            |--------------------------------------------------------------------------
            */

            // Latitude lokasi makanan
            $table->decimal('latitude', 10, 7)->nullable();

            // Longitude lokasi makanan
            $table->decimal('longitude', 10, 7)->nullable();

            // Alamat lengkap
            $table->text('address')->nullable();

            /*
            |--------------------------------------------------------------------------
            | INDEX DATABASE
            |--------------------------------------------------------------------------
            */

            // Mempercepat query status
            $table->index('status');

            // Mempercepat query user
            $table->index('user_id');

            /*
            |--------------------------------------------------------------------------
            | TIMESTAMP
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};