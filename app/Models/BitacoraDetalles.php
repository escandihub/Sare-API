<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraDetalles extends Model
{
    use HasFactory;
    protected $table = 'bitacora';
    // protected $primaryKey = 'id_total';

    protected $fillable = [
        'Descripcion','Referencia','Fecha','Entidad'
    ];
    protected $hidden = [        
    ];
}
