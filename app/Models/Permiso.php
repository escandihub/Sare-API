<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    protected $table = 'catalogopermisos';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModificado';

    protected $fillable = [
        'Permiso',
        'Status',        
    ];
}
