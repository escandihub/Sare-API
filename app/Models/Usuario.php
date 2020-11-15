<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Traits\UsuarioTrait;

class Usuario extends Authenticatable
{
    use HasFactory, UsuarioTrait;
    // protected $table = 'catalogousuarios';
    // protected $primaryKey = 'Id';

    // const CREATED_AT = 'FechaRegistro';
    // const UPDATED_AT = 'FechaModificado';

    protected $fillable = [
        'usuario',
        'nombre',
        'enlace_id',
        // 'IdGrupo',
        // 'status',
        // 'Nivel',
    ];

    protected $hidden = [
        'password'
    ];
}
