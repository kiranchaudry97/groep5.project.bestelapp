<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Maak de tabel 'categories' aan.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('naam')->unique();
            $table->timestamps();
        });
    }

    /**
     * Verwijder de tabel 'categories' indien nodig.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};