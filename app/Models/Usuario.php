<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;
    protected $table = 'catalogousuarios';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModificado';

    protected $fillable = [
        'usuario',
        'Nombre',
        'IdEnlace',
        'IdGrupo',
        'Status',
        'Nivel',
    ];

    protected $hidden = [
        'password'
    ];
    public function enlace(){
        return $this->hasOne('App\Models\Enlace', 'Id', 'IdEnlace');
    }
    public function grupo()
    {
        return $this->hasOne('App\Models\Grupo','Id', 'IdGrupo');
    }
}
