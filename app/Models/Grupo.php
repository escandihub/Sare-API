<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    // protected $table = 'catalogogrupos';
    // protected $primaryKey = 'Id';

    // const CREATED_AT = 'FechaAlta';
    // const UPDATED_AT = 'FechaModificacion';
    
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'full-access'
    ];
    protected $hidden = [
        
    ];

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario');
    }
    public function permisos(){
        return $this->belongsToMany('App\Models\Permiso');
    }
}
