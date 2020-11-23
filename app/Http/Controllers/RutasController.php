<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\menu\Ruta;
use App\Models\menu\Menu;
use App\Models\Grupo;

class RutasController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
        // $Menu = Ruta::has('menu')->get();
    
		return response()->json(Ruta::all(), 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Grupo $ruta
	 * @return \Illuminate\Http\Response
	 */
	public function show(Grupo $ruta)
	{
        // $grupo = Grupo::find($id);
        $grupo = $ruta;
        $rutas = $grupo->rutas;
        return $rutas;
        // return response()->json($rutas, 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Grupo $ruta
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Grupo $ruta)
	{
		$ruta->rutas()->sync($request->rutas);
		$nombre = $ruta->nombre;
        
    return response()->json(["message" => "Rutas del grupo " . $nombre], 200);
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
