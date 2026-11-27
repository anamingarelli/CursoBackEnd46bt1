<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Cria a tabela de equipamentos industriais.
     */
    public function up(): void {
        Schema::create('equipamentos', function (Blueprint $table): void {
            $table->id();
            $table->string('tag')->unique();
            $table->string('nome');
            $table->string('setor');
            $table->string('criticidade', 20);
            $table->string('status', 20)->default('OPERANDO');
            $table->timestamps();
        });
    }

    /**
     * Remove a tabela de equipamentos.
     */
    public function down(): void {
        Schema::dropIfExists('equipamentos');
    }
};
