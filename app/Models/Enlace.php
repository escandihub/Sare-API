<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    use HasFactory;
    protected $table = 'catalogoenlaces';
    protected $primaryKey = 'Id';    
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModificacion';

    protected $fillable = [
        'Enlace_Municipal'
    ];
    protected $hidden = [

    ];  
}
