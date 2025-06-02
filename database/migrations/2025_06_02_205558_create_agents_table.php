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
Schema::create('agents', function (Blueprint $table) {
    $table->id(); // même id que dans users
    $table->decimal('solde', 15, 2)->default(0);
    $table->string('code')->unique();
    $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
