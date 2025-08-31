<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motorcycles', function (Blueprint $table) {
            $table->ulid('id')->primary(); // ULID instead of auto-increment
            $table->string('brand');       // e.g., Honda, Yamaha
            $table->string('model');       // e.g., Click 125i
            $table->string('plate_number')->unique();
            $table->year('year')->nullable();
            $table->decimal('rental_price', 8, 2); // up to 999,999.99
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motorcycles');
    }
};
