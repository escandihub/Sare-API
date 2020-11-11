<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\BicatoraEventoLogger;
use App\Models\Traits\BitacoraModel;

class LicenciaEmpresa extends Model
{
    use HasFactory, BicatoraEventoLogger;
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
        'MesConcluido',
        'Rango'
    ];
}
