<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'catalogousuarios';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModificado';

    protected $fillable = [
        'Usuario',
        'Nombre',
        'IdEnlace',
        'IdGrupo',
        'Status',
        'Nivel',
    ];

    protected $hidden = [
        'Password'
    ];
    public function enlace(){
        return $this->hasOne('App\Models\Enlace', 'Id', 'IdEnlace');
    }
    public function grupo()
    {
        return $this->hasOne('App\Models\Grupo','Id', 'IdGrupo');
    }
}
