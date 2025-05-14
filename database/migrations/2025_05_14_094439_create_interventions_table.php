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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->foreignId('louerchambre_id')->constrained("louerchambres")->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('description');
            $table->enum('statut', ['EN ATTENTE', 'CONFIRMER', 'REJETER', 'ARCHIVER'])->default('EN ATTENTE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
