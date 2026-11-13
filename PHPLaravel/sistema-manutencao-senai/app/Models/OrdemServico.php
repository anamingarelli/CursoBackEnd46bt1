<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// classe responsável por conversar com o banco de dados => insert, select, update, delete

class OrdemServico extends Model
{
    protected $fillable = ["codigo", "titulo", "equipamento_id", "tipo", "proridade", "status", "tecnico", "data_abertura", "prazo_limite"];
}
