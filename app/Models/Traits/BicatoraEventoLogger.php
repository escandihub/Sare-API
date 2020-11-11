<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bitacora;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait BicatoraEventoLogger {

/**
 * Automatically boot with Model, and register Events handler.
 */


	public static function booted()
  {

	$user_id = Auth::user()->id;
	foreach (static::getRecordActivityEvents() as $eventName) {


	  static::$eventName(function (Model $model) use ($user_id, $eventName) {
		$reflect = new \ReflectionClass($model);
		\Log::info('Evento : ' . $eventName);
		\Log::info('Usuario : ' . $user_id);
		\Log::info('Modelo : ' . get_class($model));
		\Log::info('reflection : ' . ucfirst($eventName) . " a " . $reflect->getShortName());
		\Log::info("detalles: " . $model);
		\Log::info("reflect: " . $reflect);
		$log = [
		  'IdUsuario'=> $user_id,
		  'descripcion' => $eventName,
		  "referencia" => ucfirst($eventName) . " a " . $reflect->getShortName(),
		  "entidad" => $reflect->getShortName(),
		  'fecha' => Carbon::now(),
		  
		  
		];          
		Bitacora::create($log);
	  });
	}    
  }    

  protected static function getRecordActivityEvents()
  {
	if (isset(static::$recordEvents)) {
	  return static::$recordEvents;
	}

	return [
	  'created',
	  'updated',
	  'deleted',
	];
  }

}
