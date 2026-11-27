<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Eloquent que representa ordens de servico de manutencao.
 */
final class OrdemServico extends Model {
    protected $table = 'ordens_servico';

    protected $fillable = [
        'codigo',
        'titulo',
        'equipamento_id',
        'tipo',
        'prioridade',
        'status',
        'tecnico',
        'data_abertura',
        'prazo_limite',
    ];

    /**
     * Retorna o equipamento associado a esta ordem de servico.
     */
    public function equipamento(): BelongsTo {
        return $this->belongsTo(Equipamento::class);
    }

    /**
     * Define o campo codigo como chave de rota no Route Model Binding.
     */
    public function getRouteKeyName(): string {
        return 'codigo';
    }
}