<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
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


    //Retornar o catalogo de ordens de serviços
    public static function todas(): array {
        return self::query()->get()->all();
    }

    //localizar uma ordem de serviço pelo código unico
    public static function buscarPorCodigo(string $codigo): ?self {
        return self::query()->where("codigo", $codigo)->first();
    }
}
