<?php
namespace App\Models\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bitacora;

trait BitacoraModel {
	public static function booted()
		{
				// parent::boot();

				/**
				 * Event: creating
				 */
				static::creating(function (Model $model) {
						\Log::info('Creating : ' . $model);
				});

				/**
				 * Event: created
				 */
				static::created(function ($model) {
						\Log::info('Created : ' . $model);
						Bitacora::create([
							'IdUsuario' => \Auth::user()->id,
							'descripcion' => json_encode($model->getDirty()),
							'entidad' => get_class($model),
							'fecha' => date('Y-m-d')

						]);
				});

				/**
				 * Event: deleted
				 */
				static::deleted(function (Model $model) {
					$reflect = new \ReflectionClass($model);
					Bitacora::create([
						'IdUsuario'=> $user_id,
		  			'descripcion' => "Eliminacion de un atributo de la entidad-modelo" . $reflect->getShortName() . " con el id = " . $model->id,
		  			"referencia" => ,
		  			"entidad" => $reflect->getShortName(),
		  			'fecha' => Carbon::now(),
					]);
					
				});
		}
}