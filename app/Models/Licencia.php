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
    protected $primaryKey = 'IdTotal';

    const CREATED_AT = 'FechaCreacion';
    const UPDATED_AT = 'FechaActualizacion';

    protected $fillable = [
        'Licencias_Emitidas',
        'Empleos_Generados',
        'Inversion_Generada',
        'No_Asesorias',
        'IdEnlaceMunicipal',
        'IdUsuario',
        'Mes',
        'Year',
        'MesConcluido',
        'Rango'
    ];
    protected $hidden = [
        // 'IdTotal'
    ];
   
    public function municipio()
    {
        return $this->hasOne('App\Models\Enlace', 'Id', 'IdEnlaceMunicipal');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\Usuario', 'Id', 'IdUsuario');
    }
}
