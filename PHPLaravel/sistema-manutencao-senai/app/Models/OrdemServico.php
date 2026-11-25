<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// classe responsável por conversar com o banco de dados => insert, select, update, delete

class OrdemServico extends Model
{
    protected $fillable = ["codigo", "titulo", "equipamento_id", "tipo", "proridade", "status", "tecnico", "data_abertura", "prazo_limite"];

    //Retornar o catálogo de ordem de serviços
    public static function todas(): array{
        return self::query()->get()->all();
    }

    //localizar uma ordem de serviço pelo código único
    public static function buscarPorCodigo(string $codigo): ?self{
        return self::query()->where("codigo", $codigo)->first();
    }
        
    }
