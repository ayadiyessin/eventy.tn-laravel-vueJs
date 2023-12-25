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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('nom_Event');
            $table->string('adresse_Event');
            $table->decimal('prix_Event', 8, 2);  // Colonne pour le prix (8 chiffres au total, 2 décimales)
            $table->date('date_Event');
            $table->integer('nbPlace_Event');
            $table->unsignedBigInteger('organisateursID');
            $table->foreign('organisateursID')
            ->references('id')
            ->on('organisateurs')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('categorieEventID');
            $table->foreign('categorieEventID')
            ->references('id')
            ->on('categorie_events')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
