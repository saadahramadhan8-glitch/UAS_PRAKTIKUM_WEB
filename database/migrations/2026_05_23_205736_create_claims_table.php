<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claims', function (Blueprint $table) {

            $table->id();

            // makanan yang di claim
            $table->foreignId('food_id')
                ->constrained('foods')
                ->onDelete('cascade');

            // user penerima
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // jumlah makanan yang diambil
            $table->integer('quantity');

            // status claim
            $table->enum('status', [

                'pending',
                'disetujui',
                'ditolak',
                'selesai'

            ])->default('pending');

            // tanggal claim
            $table->dateTime('claim_date');

            // catatan tambahan
            $table->text('notes')->nullable();

            // index status
            $table->index('status');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};