<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\BicatoraEventoLogger;

class Licencia extends Model
{
    /**
     * Modelo que se relaciona a la entidad total_licencias 
     */
    use HasFactory; //, BicatoraEventoLogger;
    protected $table = 'totales_licencias';

    const CREATED_AT = 'FechaCreacion';
    const UPDATED_AT = 'FechaActualizacion';

    protected $fillable = [
        'Licencias_Emitidas',
        'Empleos_Generados',
        'Inversion_Generada',
        'No_Asesorias',
        'IdEnlaceMunicipal',
        // 'IdUsuario',
        'Mes',
        'Year',
        // 'MesConcluido',
        // 'Rango'
    ];
    protected $hidden = [
        // 'IdTotal'
    ];
   
    public function municipio()
    {
        return $this->hasOne('App\Models\Enlace', 'id', 'IdEnlaceMunicipal');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\Usuario', 'id', 'IdUsuario');
    }
}
