<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    use HasFactory;
    protected $table = 'catalogoenlaces';
    protected $primaryKey = 'Id';
    
    protected $fillable = [
        'Enlace_Municipal','FechaModificacion'
    ];
    protected $hidden = [

    ];
}
