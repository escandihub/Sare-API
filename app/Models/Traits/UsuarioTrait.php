<?php

namespace App\Models\Traits;

trait UsuarioTrait {
  
  public function enlace(){
    return $this->hasOne('App\Models\Enlace', 'id', 'enlace_id');
}
public function grupo(){
    return $this->belongsToMany('App\Models\Grupo')->withTimesTamps();
}
  public function tienePermiso($perm){
    $grupos = $this->grupo;
    foreach ($grupos as $grupo) {
        if ($grupo['full_access'] == 'yes') {
            return true; //full access to the API
        }
        foreach ($grupo->permisos as $permiso) {
            if ($permiso->slug === $perm) { // checking if the user can do something
                return true;
            }
        }
    }
    return false;
}

public function hasMunicipio(){
	$enlace = $this->enlace;
    if(!is_null($enlace)){
        return true;
    }else{
        return false;
    }
}
}