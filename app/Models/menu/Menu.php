<?php

namespace App\Models\menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function rutas(){
        $this->hasMany("App\Models\menu\Ruta");
    }

    public function getMenuWithRutes()
    {
        return $this->has("rutas")->get();
        
    }
}
