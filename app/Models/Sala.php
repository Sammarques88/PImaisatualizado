<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = [
        'tema',
        'descricao',
        'data',
        'hora',
        'numero_participantes',
        'nome_medico',
        'laudo_obrigatorio',
    ];
}
