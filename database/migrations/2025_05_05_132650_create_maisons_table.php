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
        Schema::create('maisons', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('Pays');
            $table->string('ville');
            $table->string('quartier');
            $table->string('adresse');
            $table->foreignId('user_id')->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedTinyInteger('jourPaiementLoyer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maisons');
    }
};
