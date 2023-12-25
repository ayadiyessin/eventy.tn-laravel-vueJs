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
        Schema::create('avis_pubs', function (Blueprint $table) {
            $table->id();
            $table->string('commentaire_pub',500)->default('');
            //$table->integer('note_pub')->default(0);
            $table->unsignedBigInteger('participantsID');
            $table->foreign('participantsID')
            ->references('id')
            ->on('participants')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('publicationsID');
            $table->foreign('publicationsID')
            ->references('id')
            ->on('publications')
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
        Schema::dropIfExists('avis_pubs');
    }
};
