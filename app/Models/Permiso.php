<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BicatoraEventoLogger;

class Permiso extends Model
{
	use HasFactory, BicatoraEventoLogger;
	// protected $table = 'catalogopermisos';
	// protected $primaryKey = 'Id';

	// const CREATED_AT = 'FechaRegistro';
	// const UPDATED_AT = 'FechaModificado';

	protected $fillable = ["nombre", "slug", "descripcion"];

	public function grupo()
	{
		return $this->belongsToMany("App\Models\Grupo")->withTimesTamps();
	}
	public function usuario()
	{
		return $this->hasMany("App\Models\Usuarios");
	}
}
