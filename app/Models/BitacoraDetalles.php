<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraDetalles extends Model
{
	use HasFactory;
	protected $table = "bitacora";
	protected $primaryKey = "id";

	public $timestamps = false;

	protected $fillable = [
		"IdUsuario",
		"IdTipo",
		"Descripcion",
		"Referencia",
		"Entidad",
	];
	protected $hidden = [];

	public function tipo()
	{
		return $this->hasOne("App\Model\Bitacora");
	}

	public function usuario()
	{
		return $this->hasOne("App\Model\Usuario");
	}

	/**
	 * Este metodo permite solamente utilizar el create_at
	 */
	public static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			$model->Fecha = $model->freshTimestamp();
		});
	}
}
