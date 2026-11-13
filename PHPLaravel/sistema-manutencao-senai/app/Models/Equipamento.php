<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// classe responsável por conversar com o banco de dados => insert, select, update, delete

class Equipamento extends Model
{
    protected $fillable = ["tag", "nome", "setor", "criticidade", "status"];
}
