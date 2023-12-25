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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('nb_Tick');
            $table->unsignedBigInteger('participantsID');
            $table->foreign('participantsID')
            ->references('id')
            ->on('participants')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('evenementsID');
            $table->foreign('evenementsID')
            ->references('id')
            ->on('evenements')
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
        Schema::dropIfExists('tickets');
    }
};
