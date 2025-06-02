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
Schema::create('comptes', function (Blueprint $table) {
    $table->id();
    $table->string('numero')->unique();
    $table->decimal('solde', 15, 2)->default(0);
    $table->enum('statut', ['actif', 'inactif'])->default('actif');
    $table->unsignedBigInteger('client_id');
    $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
