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

    public function enlace(){
        return $this->hasOne('App\Models\Enlace', 'Id', 'IdEnlace');
    }
    public function grupo()
    {
        return $this->hasOne('App\Models\Grupo','Id', 'IdGrupo');
    }
}
