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
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->enum('statut', ['Disponible', 'Non disponible'])->default('Disponible');
            $table->unsignedTinyInteger('jourPaiementLoyer');
            $table->double('loyer');
            $table->foreignId('categorie_id')->constrained("categories")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('type_id')->constrained("types")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('maison_id')->constrained("maisons")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};
