<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Foundation\Auth\User as Authenticatable;// se quiser autenticação
use Illuminate\Notifications\Notifiable;

class Medico extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
       'usuario_id',
        'especialidade',
        'crm',
        
    ];

    protected $hidden = ['password'];
}