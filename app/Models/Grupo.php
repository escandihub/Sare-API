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

	protected $fillable = ["nombre", "slug", "descripcion", "full-access"];
	protected $hidden = [];

	public function usuario()
	{
		return $this->belongsToMany("App\Models\Usuario")->withTimesTamps();
	}
	public function permisos()
	{
		return $this->belongsToMany("App\Models\Permiso")->withTimesTamps();
	}

	public function rutas()
	{
		return $this->BelongsToMany("App\Models\menu\Ruta");
	}

	public function getRutas()
	{
		$userRoutes = [];
		//model rutas context
		foreach ($this->rutas as $ruta) {
			$menu = $ruta->menu->toArray(); //get the actual menu of the route on raw object
			$userRoutes = $this->isAdded($userRoutes, $menu); //check is the menu is already added on the Array
			foreach ($userRoutes as $key => $route) {
				//iterator to see the menu match with route_menu_id to add where to correponde
				if ($route["id"] == $ruta["menu_id"]) {
					array_push($userRoutes[$key]["submenu"], $ruta);
				}
			}
		}
		return $userRoutes;
	}

	public function isAdded($slide, $menu)
	{
		if (empty($slide)) {
			$lastKey = array_push($slide, $menu) - 1;
			$slide[$lastKey]["submenu"] = [];
		} else {
			if (!$this->existe($slide, $menu["id"])) {
				$lastKey = array_push($slide, $menu) - 1;
				$slide[$lastKey]["submenu"] = [];
			}
		}
		return $slide;
	}
	public function existe($slice, $newMenu)
	{
		foreach ($slice as $menu) {
			if($menu["id"] == $newMenu){
				return true;
			}
			
		}
	}
}
