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
        Schema::create('historique_paiadm', function (Blueprint $table) {
            $table->id();
            $table->date('datePaiement')->nullable();
            $table->string('quittanceUrl')->nullable();
            $table->double('montant');
            $table->string('modePaiement')->nullable();
            $table->string('idTransaction')->nullable();
            $table->string('moisPaiement')->nullable();
            $table->enum('statut', ['EN ATTENTE', 'PAYER'])->default('EN ATTENTE');
            $table->foreignId('user_id')->constrained("users")->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_paiadm');
    }
};
