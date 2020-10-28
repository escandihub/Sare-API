<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use Illuminate\Http\Request;
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
    public function index()
    {
        $fecha = date('Y');
        $licencias = Licencia::where('Year', '=', $fecha)->get();
        return response()->json($licencias, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Licencia::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function show(Licencia $licencia)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Licencia $licencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licencia $licencia)
    {
        //
    }
}
