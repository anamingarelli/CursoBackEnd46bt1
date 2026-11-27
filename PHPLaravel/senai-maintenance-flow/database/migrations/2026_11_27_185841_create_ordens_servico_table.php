<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Cria a tabela de ordens de servico com chave estrangeira para equipamentos.
     */
    public function up(): void {
        Schema::create('ordens_servico', function (Blueprint $table): void {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('titulo');
            $table->foreignId('equipamento_id')->constrained('equipamentos')->restrictOnDelete();
            $table->string('tipo', 20);
            $table->string('prioridade', 20);
            $table->string('status', 20)->default('ABERTA');
            $table->string('tecnico');
            $table->date('data_abertura');
            $table->date('prazo_limite');
            $table->timestamps();
        });
    }

    /**
     * Remove a tabela de ordens de servico.
     */
    public function down(): void {
        Schema::dropIfExists('ordens_servico');
    }
};
