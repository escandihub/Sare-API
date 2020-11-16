<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    // protected $table = 'catalogogrupos';
    // protected $primaryKey = 'Id';

    // const CREATED_AT = 'FechaAlta';
    // const UPDATED_AT = 'FechaModificacion';
    
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'full-access'
    ];
    protected $hidden = [
        
    ];

    public function usuario()
    {
        return $this->belongsToMany('App\Models\Usuario')->withTimesTamps();
    }
    public function permisos(){
        return $this->belongsToMany('App\Models\Permiso')->withTimesTamps();
    }

    public function rutas()
	{
		return $this->BelongsToMany("App\Models\menu\Ruta");
    }
    
    public function getRutas()
	{
        $routes = [];
        $slide = [];
        // Grupo::find(2)->rutas
		foreach ($this->rutas as $ruta) {
            $menu = $ruta->menu;
            array_push($slide, $menu);
            // return $slide;
            if($menu["id"] == $ruta["menu_id"]){
                array_push($routes, $ruta["route"]);
                foreach($slide as $main){
                if($main["id"] == $ruta["id"]){
                 $main["submenu"] = $routes;
                }
            }
            }
            
        }
        return $slide;
        
	}
}
