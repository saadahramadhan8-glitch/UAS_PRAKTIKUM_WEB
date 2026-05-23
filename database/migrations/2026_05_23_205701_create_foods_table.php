<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foods', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('title');

            $table->text('description');

            $table->integer('quantity');

            $table->dateTime('expired_at');

            $table->string('image')->nullable();

            $table->enum('status', [
                'pending_verification',
                'tersedia',
                'diklaim',
                'diproses',
                'diantar',
                'selesai',
                'kadaluarsa'
            ])->default('pending_verification');

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->text('address')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};