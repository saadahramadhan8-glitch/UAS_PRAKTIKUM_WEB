<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {

            $table->id();

            $table->foreignId('claim_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('courier_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->enum('delivery_status', [
                'pending',
                'pickup',
                'delivering',
                'completed'
            ])->default('pending');

            $table->dateTime('delivery_date')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};