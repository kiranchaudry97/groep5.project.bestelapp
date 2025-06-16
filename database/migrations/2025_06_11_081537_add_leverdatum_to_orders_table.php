<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Voeg een kolom toe aan de orders-tabel.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->date('leverdatum')->nullable();
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('leverdatum');
    });
}
};