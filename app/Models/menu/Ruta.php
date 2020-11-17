<?php

namespace App\Models\menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    
    public function grupo(){
        $this->belongsToMany("App\Models\Grupo");
    }
    

    public function menu(){
        return $this->belongsTo('App\Models\menu\Menu');
    }
}
