<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// Modelo representativo de um Ativo Fabril
class Ativo extends Model
{
    use HasFactory; // uma Biblioteca para habilitar a fábrica de modelos

    protected $table = 'ativos'; //nome da tabela no banco de dados

    // atributos da tabela ativos (colunas) ()
    protected $fillable = [
        "codigo_patrimonio",
        "nome",
        "setor",
        "status",
        "tensao_operacao",
        "horas_trabalhadas"
    ];
}
