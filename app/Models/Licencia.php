<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    /**
     * Modelo que se relaciona a la entidad total_licencias 
     */
    use HasFactory;
    protected $table = 'totales_licencias';
    protected $primaryKey = 'id_total';

    protected $fillable = [
        'Licencias_Emitidad',
        'Empleos_Generados',
        'Inversion_Generada',
        'No_Asesorias',
        'IdEnlaceMunicipal',
        'IdUsuario',
        'Mes',
        'Year',
        'FechaCreacion',
        'FechaActualizacion',
        'mes',
        'Rango'
    ];
}
