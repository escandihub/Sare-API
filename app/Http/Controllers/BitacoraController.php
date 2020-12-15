<?php

namespace App\Http\Controllers;

use App\Http\Requests\BitacoraRequest;
use App\Models\Bitacora;
use App\Models\bitacoraTipo;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		\Gate::authorize("tiene-acceso", "bitacora.index");
		$validarFechas = $request->validate([
			"fecha_inicio" => "date",
			"fecha_fin" => "date",
		]);
		//verificar si en el params se encuentra datos
		$date_inicial = !$validarFechas
			? date("Y-01-01")
			: Date($request->fecha_inicio);
		$date_final = !$validarFechas ? date("Y-12-31") : Date($request->fecha_fin);

		$request->tipo_id == ""
			? ($bitacoras = Bitacora::whereBetween("Fecha", [
				$date_inicial,
				$date_final,
			])
				->with("movimiento", "usuario")
				->orderBy("Fecha", "desc")
				->paginate(10))
			: ($bitacoras = Bitacora::whereBetween("Fecha", [
				$date_inicial,
				$date_final,
			])
				->where("tipo_id", $request->tipo_id)
				->with("movimiento", "usuario")
				->orderBy("Fecha", "desc")
				->paginate(10));
		return response()->json($bitacoras, 200);
	}
	public function movimientos()
	{
		\Gate::authorize("tiene-acceso", "bitacora.index");
		$tipos = bitacoraTipo::all();

		return response()->json(
			[
				"movimientos" => $tipos,
			],
			200
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(BitacoraRequest $request)
	{
		Bitacora::create($request->all());
		return response()->json(["message" => "Movimiento agregado"], 201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(BitacoraRequest $request, Bitacora $bitacora)
	{
		$bitacora->update($request->all());
		return response()->json(["message" => "Movimiento agregado"], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
