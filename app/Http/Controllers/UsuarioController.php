<?php

namespace App\Http\Controllers;
use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use App\Models\Grupo;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$usuarios = Usuario::with(["enlace", "grupo"])->get();

		return response()->json($usuarios, 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(UsuarioRequest $request)
	{
		\Gate::authorize("tiene-acceso", "full-access");
		$usuario = new Usuario();
		$password = Hash::make($request->password);

		$usuario->usuario = $request->usuario;
		$usuario->nombre = $request->nombre;
		$usuario->enlace_id = $request->enlace_id;
		$usuario->password = $password;
		$usuario->status = "1";
		$usuario->save();
		$usuario->grupo()->sync($request->grupo_id);

		return response()->json(
			["menssage" => "Se ha agregado un nuevo usuario", "usuario" => $usuario],
			200
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Usuario  $usuario
	 * @return \Illuminate\Http\Response
	 */
	public function show(Usuario $usuario)
	{
		return response()->json($usuario, 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Usuario  $usuario
	 * @return \Illuminate\Http\Response
	 */
	public function update(UsuarioRequest $request, Usuario $usuario)
	{
		\Gate::authorize("tiene-acceso", "full-access");
		$usuario->update($request->all());
		return response()->json(["message" => "Se ha actualizado el usuario"], 200);
	}

	public function destroy(Request $request, Usuario $usuario)
	{
		\Gate::authorize("tiene-acceso", "full-access");
		$usuario->delete();
		return response()->json(
			["Se ha eliminado el Usuario " . $usuario->usuario . " con exito"],
			200
		);
	}
}