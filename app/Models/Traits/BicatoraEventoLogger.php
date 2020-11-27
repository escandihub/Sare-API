<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bitacora;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait BicatoraEventoLogger
{
	/**
	 * Automatically boot with Model, and register Events handler.
	 */

	public static function booted()
	{
		$user_id = Auth::user()->id;
		foreach (static::getRecordActivityEvents() as $eventName) {
			static::$eventName(function (Model $model) use ($user_id, $eventName) {
				$reflect = new \ReflectionClass($model);
				// \Log::info('Evento : ' . $eventName);
				// \Log::info('Usuario : ' . $user_id);
				// \Log::info('Modelo : ' . get_class($model));
				// \Log::info('reflection : ' . ucfirst($eventName) . " a " . $reflect->getShortName());
				// \Log::info("detalles: " . $model);
				// \Log::info("reflect: " . $reflect);

				// \Log::info('user_id: '     .  $user_id);
				// \Log::info('contentId: '   .  $model->id);
				// \Log::info('contentType: ' .  get_class($model));
				// \Log::info('action: '      .  static::getActionName($eventName));
				// \Log::info('description: ' .  ucfirst($eventName) . " a " . $reflect->getShortName());
				// \Log::info('details: '     .  json_encode($model->getDirty()));

				$descripcion = ucfirst($eventName) . " a " . $reflect->getShortName();
				$tipo_operacion_id = static::getActionName($eventName);
				$log = [
					"usuario_id" => $user_id,
					"entidad" => get_class($model),
					"referencia" => $model->id,
					"descripcion" => $descripcion,
					"tipo_id" => intval($tipo_operacion_id),
					"fecha" => Carbon::now(),
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

		return ["created", "updated", "deleted"];
	}
	protected static function getActionName($event)
	{
		switch (strtolower($event)) {
			case "created":
				return 2; //'Creacion';
				break;
			case "updated":
				return 3; //'Actualizacion';
				break;
			case "deleted":
				return 4; //'Eliminacion';
				break;
			default:
				return "Desconocido";
		}
	}
}
