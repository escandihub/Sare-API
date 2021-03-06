<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenciaEmpresaRequest;
use App\Models\LicenciaEmpresa;
use App\Models\Usuario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/**
 * Super Usuario  =>  Eliminar y Editar (ALL)
 * Enlace Municipal => Eliminar y Editar (Solo su municipio)(opcion) => Habilidad
 * Administrador SARE => Visualizar Información
 */
/***
 * Controlador que se relaciona con la entidad licencia_empresa
 *  => Licencias por empresa
 */
class LicenciaEmpresaController extends Controller
{
	public function __construct()
	{
		// $this->authorizeResource(LicenciaEmpresa::class);
		// $this->middleware('can:show,method')->only('show');
		// $this->authorize('update', $brewMethod)
	}
	/**
	 * Display a listing of the resource.
	 * @Auth  {Ususario} checa si pertenece a algun municipio
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

		$licencia_empresa = LicenciaEmpresa::query();

		if (!\Gate::allows("tiene-acceso", "full-access")) {
			$licencia_empresa->where(
				"IdEnlaceMunicipal",
				"=",
				Auth::user()->enlace->id
			);
			$licencia_empresa
				->whereBetween("FechaCreacion", [$dataInicial, $dataFinal])
				->with("municipio")
				->orderBy("FechaCreacion", "desc");
		} else {
			//super user or admin
			$licencia_empresa
				->whereBetween("FechaCreacion", [$dataInicial, $dataFinal])
				->with("municipio")
				->orderBy("FechaCreacion", "desc");
		}

		return response()->json($licencia_empresa->paginate(12), 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(LicenciaEmpresaRequest $request)
	{
		$this->authorize("create", LicenciaEmpresa::class);

		$usuario = \Auth::user();
		$addInfo = [
			"IdEnlaceMunicipal" => $usuario->enlace->id,
			"IdUsuario" => $usuario->id,
			"MesConcluido" => 0,
		];

		LicenciaEmpresa::create(array_merge($request->all(), $addInfo));
		return response()->json(["message" => "Registro agregado"], 201);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\LicenciaEmpresa  $licenciaEmpresa
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, LicenciaEmpresa $captura)
	{
		$isSuper = \Gate::inspect("tiene-acceso", "full-access");

		if ($isSuper->allowed()) {
			$captura->update($request->all());
		} else {
			$this->authorize("update", $captura); //this is a policy
			$captura->update($request->all());
		}

		return response()->json(
			["message" => "Se actualizo una nueva Licencia por Empresa"],
			200
		);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\LicenciaEmpresa  $licenciaEmpresa
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(LicenciaEmpresa $captura)
	{
		$isSuper = \Gate::inspect("tiene-acceso", "full-access");
		if ($isSuper->allowed() || \Gate::allows("delete", $captura)) {
			$captura->delete();
			return response()->json(
				["message" => "Se ha eliminado una licencia"],
				200
			);
		} else {
			return response()->json(
				["message" => "Sin privilegios sufiententes"],
				422
			);
		}
	}

	/**
	 * Consulta de entre dos fechas fechas
	 * @request year-month-day
	 * @return \Illuminate\Http\Response
	 */

	public function porFechas(Request $request)
	{
		$dataInicial = Date($request->fecha_inicio);
		$dataFinal = Date($request->fecha_fin);

		$lista = LicenciaEmpresa::whereBetween("FechaCreacion", [
			$dataInicial,
			$dataFinal,
		])->paginate(10);

		return response()->json($lista, 200);
	}
}
