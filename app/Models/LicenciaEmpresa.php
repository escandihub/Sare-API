<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenciaEmpresa extends Model
{
    use HasFactory;
    protected $table = 'licencias_empresa';
    protected $primaryKey = 'IdLicencia';

    const CREATED_AT = 'FechaCreacion';
    const UPDATED_AT = 'FechaActualizacion';
    
    protected $fillable = [
        'Empresa',
        'Giro',
        'Inversion',
        'No_Empleo',
        'IdEnlaceMunicipal',
        'Mes',
        'Year',
        'IdUsuario',
        'FechaCreacion',
        'FechaActualizacion',
        'MesConcluido',
        'Rango'
    ];
}
