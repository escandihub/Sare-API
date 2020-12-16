<?php

namespace App\Http\Controllers\Rules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CierreCaptura;

class CierreCapturaFechasController extends Controller
{
	public function index()
	{
		\Gate::authorize('tiene-acceso', 'fechas.index');
		$fechas = CierreCaptura::findOrFail(1);
		return response()->json($fechas, 200);
	}
	public function update(CierreCaptura $captura_fecha, Request $request)
	{
		\Gate::authorize('tiene-acceso', 'fechas.index');
		$validate = $request->validate([
			"fecha_inicial" => "required",
			"fecha_final" => "required",
		]);
		$captura_fecha->update($request->all());

		return response()->json(
			["message" => "Se ha actualizado las fechas con exito"],
			201
		);
	}
}
