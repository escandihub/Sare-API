<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use Illuminate\Http\Request;
use App\Http\Requests\LicenciaRequest;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Super Usuario  =>  Eliminar y Editar (ALL)
 * Enlace Municipal => Eliminar y Editar (Solo su municipio)(opcion) => Habilidad
 * Administrador SARE => Visualizar Información
 */

/***
 * Controlador que se relaciona con la entidad totales_licencias
 *  => Indicador general
 */
class LicenciaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$validarFechas = $request->validate([
			"fecha_inicio" => "date",
			"fecha_fin" => "date",
		]);

		// verificar si en el params se encuntran datos
		$dataInicial = !$validarFechas
			? date("Y-01-01")
			: Date($request->fecha_inicio);
		$dataFinal = !$validarFechas ? date("Y-12-31") : Date($request->fecha_fin);

		$licencia_captura = Licencia::query();
		if (!\Gate::allows("tiene-acceso", "full-access")) {
			//sera el usuario que registre la operacion no deberia ser el municipio del usuario
			$licencia_captura->where("IdEnlaceMunicipal", "=", \Auth::user()->enlace->id); // Auth::user()->enlace->id
			$licencia_captura
				->whereBetween("FechaCreacion", [$dataInicial, $dataFinal])
				->with("municipio")
				->orderBy("FechaCreacion", "desc");
		} else {
			$licencia_captura
				->whereBetween("FechaCreacion", [$dataInicial, $dataFinal])
				->with("municipio")
				->orderBy("FechaCreacion", "desc");
		}
		return response()->json($licencia_captura->paginate(10), 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(LicenciaRequest $request)
	{
		// $request->municipio
		// $request->month
		$indicador = Licencia::create($request->all());
		$indicador->IdUsuario = \Auth::user()->id;
		$indicador->IdEnlaceMunicipal = \Auth::user()->enlace->id;
		$indicador->MesConcluido = 0;
		$indicador->save();

		return response()->json(
			["message" => "Se ha agreado un Nuevo indicador"],
			201
		);
	}

	/**
	 * Update the specified resource in storage.
	 * @param route $identificador
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Licencia  $licencia
	 * @return \Illuminate\Http\Response
	 */
	public function update(LicenciaRequest $request, Licencia $licencia)
	{
		$licencia->update($request->all());
		return response()->json(
			[
				"menssage" => "Actualizacion con exito",
				"licencia" => $licencia,
			],
			200
		);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Licencia  $licencia
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Licencia $licencia)
	{
		$licencia->delete();
		return response()->json(["message" => "Se ha Eliminado"], 200);
	}

	/**
	 * Consulta de entre dos fechas fechas
	 * @request year-month-day
	 * @return \Illuminate\Http\Response
	 */

	public function rangoFecha(Request $request)
	{
		// return response()->json($request->input('fecha_inicio'), 200);
		$dataInicial = Date($request->fecha_inicio);
		$dataFinal = Date($request->fecha_fin);

		$licenciaTable = Licencia::query();

		if ($dataInicial != null && $dataFinal != null);
		$licenciaTable = $licenciaTable->whereBetween("FechaCreacion", [
			$dataInicial,
			$dataFinal,
		]);

		$licencias = $licenciaTable->paginate(10);

		return response()->json($licencias, 200);

		//    $lista = Licencia::whereBetween('FechaCreacion', [$dataInicial, $dataFinal])->paginate(10);
		//    $lista = Licencia::paginate(10);
	}
}
