<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $fillable = ["tag", "nome", "setor", "criticidade", "status"];


    //buscnar equipemanto por id
    public static function buscarPorId(int $id): ?self {
        foreach (self::todos() as $equipamento) {
            if ($equipamento->id === $id) {
                return $equipamento;
            }
        }
        return null;
    }

    //falta a função para listar todos os equipamentos
    public static function todos(): array {
        return [
            new self(['id' => 1, 'tag' => 'CNC-01', 'nome' => 'Torno CNC 5 Eixos Romi', 'setor' => 'Usinagem', 'criticidade' => 'ALTA', 'status' => 'OPERANDO']),
            new self(['id' => 2, 'tag' => 'PRS-04', 'nome' => 'Prensa Hidráulica 200T', 'setor' => 'Estamparia', 'criticidade' => 'CRITICA', 'status' => 'MANUTENCAO']),
            new self(['id' => 3, 'tag' => 'ROB-02', 'nome' => 'Robô Soldador KUKA', 'setor' => 'Montagem', 'criticidade' => 'ALTA', 'status' => 'OPERANDO']),
            new self(['id' => 4, 'tag' => 'CMP-01', 'nome' => 'Compressor Parafuso Schulz', 'setor' => 'Utilidades', 'criticidade' => 'MEDIA', 'status' => 'OPERANDO']),
            new self(['id' => 5, 'tag' => 'INJ-03', 'nome' => 'Injetora Termoplástica Engel', 'setor' => 'Polímeros', 'criticidade' => 'BAIXA', 'status' => 'PARADO'])
        ];
    }
}
