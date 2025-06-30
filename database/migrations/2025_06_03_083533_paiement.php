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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('destinataire_id')->nullable();
            $table->foreignId('tontine_id')->constrained()->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->enum('statut', ['valide', 'en_attente', 'echec'])->default('en_attente');
            $table->enum('type', ['deposit', 'withdraw']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
