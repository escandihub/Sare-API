<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'catalogogrupos';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'FechaAlta';
    const UPDATED_AT = 'FechaModificacion';
    
    protected $fillable = [
        'Grupo',
        'Descripcion',
        'Status'
    ];
    protected $hidden = [
        
    ];
}
