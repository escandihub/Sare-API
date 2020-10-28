<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'catalogousuarios';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Usuario',
        'Password',
        'Nombre',
        'IdEnlace',
        'IdGrupo',
        'Status',
        'Nivel',
        'FechaRegistro',
        'FechaModificado'
    ];
}
