<?php

namespace App\Models\menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];
    public function grupos(){
        $this->belongsToMany("App\Models\Grupo");
    }
    

    public function menu(){
        return $this->belongsTo('App\Models\menu\Menu');
    }
}
