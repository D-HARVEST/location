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
        Schema::create('historiquepaiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('louerchambre_id')->constrained("louerchambres")->cascadeOnUpdate();
            $table->date('datePaiement')->nullable();
            $table->string('quittanceUrl')->nullable();
            $table->double('montant');
            $table->string('modePaiement')->nullable();
            $table->string('idTransaction');
            $table->string('moisPaiement')->nullable();
            $table->foreignId('user_id')->constrained("users")->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiquepaiements');
    }
};
