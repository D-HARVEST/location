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
        Schema::create('paiementespeces', function (Blueprint $table) {
            $table->id();
            $table->string('Motif');
            $table->double('Montant');
            // $table->date('DateReception');
            $table->date('Date');
            $table->string('Mois');
            $table->string('observation')->nullable();
            $table->foreignId('louerchambre_id')->constrained("louerchambres");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiementespeces');
    }
};
