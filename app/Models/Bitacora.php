<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
	use HasFactory;
	protected $table = "bitacora";
	public $timestamps = false;
	protected $fillable = [
		"usuario_id",
		"entidad",
		"referencia",
		"descripcion",
		"fecha",
		"tipo_id",
	];
	protected $hidden = [];

	function movimiento()
	{
		return $this->hasOne("App\Models\BitacoraTipo", "id", "tipo_id");
	}
	function usuario()
	{
		return $this->hasOne("App\Models\Usuario", "id", "usuario_id");
	}
	
}
