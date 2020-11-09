<?php

namespace App\Models\Traits;

trait UsuarioTrait {
  
  public function enlace(){
    return $this->hasOne('App\Models\Enlace', 'Id', 'IdEnlace');
}
public function grupo(){
    return $this->belongsToMany('App\Models\Grupo');
}
  public function tienePermiso($perm){
    $grupos = $this->grupo;
    foreach ($grupos as $grupo) {
        if ($grupo['full_access'] == 'yes') {
            return true; //full access to the API
        }
        foreach ($grupo->permisos as $permiso) {
            if ($permiso->slug === $perm) {
                return true;
            }
        }
    }
    return false;
}
}