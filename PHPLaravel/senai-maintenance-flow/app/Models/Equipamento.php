<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Eloquent que representa equipamentos do parque fabril.
 */
final class Equipamento extends Model {
    protected $fillable = ['tag', 'nome', 'setor', 'criticidade', 'status'];

    /**
     * Retorna as ordens de servico vinculadas ao equipamento.
     */
    public function ordensServico(): HasMany {
        return $this->hasMany(OrdemServico::class);
    }
}