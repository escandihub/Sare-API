<?php

namespace App\Http\Controllers;

use App\Http\Requests\BitacoraRequest;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$bitacoras = Bitacora::all();
		return response()->json($bitacoras, 200);
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
