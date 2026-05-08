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
        Schema::create('people', function (Blueprint $table) {
            $table->id(); // Cria a coluna id com auto incremento.
            $table->timestamps(); // Cria as colunas created_at e updated_at.
            $table->string('name'); // Nome da pessoa.
            $table->string('email')->unique(); // Email unico da pessoa.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
