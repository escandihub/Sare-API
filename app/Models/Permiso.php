<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    protected $table = 'catalogopermisos';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Permiso',
        'Status',
        'FechaRegistro',
        'FechaModificado'
    ];
}
