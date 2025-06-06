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
        Schema::create('attributions', function (Blueprint $table) {
            $table->id('id_attribution');
            $table->unsignedBigInteger('id_etudiant');
            $table->foreign('id_etudiant')->references('id_etudiant')->on('etudiants')->onDelete('cascade');
            $table->unsignedBigInteger('id_enseignement');
            $table->foreign('id_enseignement')->references('id_enseignement')->on('enseignements')->onDelete('cascade');
            $table->unsignedBigInteger('id_raison');
            $table->foreign('id_raison')->references('id_raison')->on('raisons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributions');
    }
};
