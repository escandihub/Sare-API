<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use App\Http\Requests\GrupoRequest;

/**
 * entidad grupos
 * Agregar
 * 3 => update
 *
 */
class GrupoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		\Gate::authorize('tiene-acceso', 'grupo.index');
		$grupos = Grupo::all();
		return response()->json($grupos, 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(GrupoRequest $request)
	{
		\Gate::authorize('tiene-acceso', 'grupo.update');
		$grupo = Grupo::create($request->all());
		return response()->json(
			["message" => "Grupo agregado", "grupo" => $grupo],
			201
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		\Gate::authorize('tiene-acceso', 'grupo.index');
		$permisos = Grupo::find($id)->permisos;
		return response()->json($permisos, 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(GrupoRequest $request, Grupo $grupo)
	{
		\Gate::authorize('tiene-acceso', 'grupo.update');
		$grupo->update($request->all());
		$grupo->permisos()->sync($request->privilegios);
		return response()->json(["message" => "Grupo actualizado"], 200);
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
