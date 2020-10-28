<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'catalogogrupos';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Grupo','Descripcion','Status','FechaAlta','FechaModificacion'
    ];
    protected $hidden = [

    ];
}
