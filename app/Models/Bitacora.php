<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $table = 'catalogobitacora';
    protected $primaryKey = 'IdTipo';
    
    protected $fillable = [
        'TipoMovimiento'
    ];
    protected $hidden = [

    ];
}
