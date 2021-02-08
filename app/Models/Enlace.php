<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BicatoraEventoLogger;

class Enlace extends Model
{
	use HasFactory, BicatoraEventoLogger;
	protected $table = "catalogoenlaces";
	// protected $primaryKey = 'Id';
	const CREATED_AT = "FechaRegistro";
	const UPDATED_AT = "FechaModificacion";

	protected $fillable = ["Enlace_Municipal"];
	protected $hidden = [];

	public function usuario()
	{
		return $this->belongsTo("App\Models\Usuario");
	}
}