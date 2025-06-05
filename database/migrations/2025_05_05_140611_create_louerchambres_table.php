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
        Schema::create('louerchambres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chambre_id')->constrained("chambres")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullable()->constrained("users")->nullOnDelete()->cascadeOnUpdate();
            $table->date('debutOccupation')->nullable();
            $table->double('loyer')->nullable();
            $table->enum('statut', ['EN ATTENTE', 'CONFIRMER', 'REJETER', 'ARCHIVER'])->default('EN ATTENTE');
            $table->double('cautionLoyer')->nullable();
            $table->double('cautionElectricite')->nullable();
            $table->double('cautionEau')->nullable();
            $table->string('copieContrat')->nullable();
            $table->unsignedTinyInteger('jourPaiementLoyer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('louerchambres');
    }
    
};
