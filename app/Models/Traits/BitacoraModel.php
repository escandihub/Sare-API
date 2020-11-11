<?php
namespace App\Models\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bitacora;
use Carbon\Carbon;

trait BitacoraModel {
	public static function booted()
		{
				parent::boot();

				/**
				 * Event: created
				 */
				static::created(function (Model $model) {
						\Log::info('Created : ' . $model);
						$reflect = new \ReflectionClass($model);
						Bitacora::create([
							'IdUsuario' => \Auth::user()->id,
							'descripcion' => "Creacion del modelo" . $reflect->getShortName() . " con el id = " . $model->id,
							'entidad' => get_class($model),
							'fecha' => date('Y-m-d')

						]);
				});

				/**
				 * Event: Updated Model
				 */
				static::updated(function (Model $model) {
					$reflect = new \ReflectionClass($model);
			});

				/**
				 * Event: deleted
				 */
				static::deleted(function (Model $model) {
					$reflect = new \ReflectionClass($model);
					Bitacora::create([
						'IdUsuario'=> $user_id,
		  			'descripcion' => "Eliminacion de un atributo de la entidad-modelo" . $reflect->getShortName() . " con el id = " . $model->id,
		  			"referencia" => 'ero',
		  			"entidad" => $reflect->getShortName(),
		  			'fecha' => Carbon::now(),
					]);
					
				});
		}
}