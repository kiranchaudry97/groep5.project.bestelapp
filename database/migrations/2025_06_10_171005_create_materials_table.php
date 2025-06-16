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
    Schema::create('materials', function (Blueprint $table) {
        $table->id();
        $table->string('naam');
        $table->string('categorie');
        $table->integer('voorraad');
        $table->text('beschrijving')->nullable();
        $table->timestamps();
    });
}

};
