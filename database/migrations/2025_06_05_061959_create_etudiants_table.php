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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id('id_etudiant');
            $table->unsignedBigInteger('id_personne');
            $table->foreign('id_personne')->references('id_personne')->on('personnes')->onDelete('cascade');
            $table->unsignedBigInteger('id_niveau');
            $table->foreign('id_niveau')->references('id_niveau')->on('niveaux')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
