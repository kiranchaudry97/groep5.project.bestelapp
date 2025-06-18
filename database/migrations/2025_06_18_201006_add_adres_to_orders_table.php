<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Voeg de kolom 'adres' toe aan de orders-tabel.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('adres')->nullable()->after('status');
        });
    }

    /**
     * Verwijder de kolom 'adres' uit de orders-tabel.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('adres');
        });
    }
};