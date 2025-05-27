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
        Schema::create('paiementenattentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('louerchambre_id')->constrained("louerchambres")->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('dateLimite');
            $table->double('montant');
            $table->enum('statut', ['EN ATTENTE', 'EN RETARD'])->default('EN ATTENTE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiementenattentes');
    }
};
