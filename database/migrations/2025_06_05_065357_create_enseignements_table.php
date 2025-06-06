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
        Schema::create('enseignements', function (Blueprint $table) {
            $table->id('id_enseignement');
            $table->unsignedBigInteger('id_prof');
            $table->foreign('id_prof')->references('id_prof')->on('profs')->onDelete('cascade');
            $table->unsignedBigInteger('id_matiere');
            $table->foreign('id_matiere')->references('id_matiere')->on('matieres')->onDelete('cascade');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignements');
    }
};
