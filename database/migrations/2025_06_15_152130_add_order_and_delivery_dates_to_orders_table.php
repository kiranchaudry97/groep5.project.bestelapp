<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Voeg de kolom 'leverdatum' toe aan de orders-tabel, indien deze nog niet bestaat.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'leverdatum')) {
                $table->date('leverdatum')->after('status')->nullable();
            }
        });
    }

    /**
     * Verwijder de kolom 'leverdatum' uit de orders-tabel als deze bestaat.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'leverdatum')) {
                $table->dropColumn('leverdatum');
            }
        });
    }
};


