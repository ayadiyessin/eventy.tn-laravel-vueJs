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
        Schema::create('avis_evens', function (Blueprint $table) {
            $table->id();
            $table->string('commentaire_Event',500)->default('');
            //$table->integer('note_pub')->default(0);
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
        Schema::dropIfExists('avis_evens');
    }
};
