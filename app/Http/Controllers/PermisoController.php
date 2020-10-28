<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermisoRequest;
use Carbon\Carbon;
use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permisos = Permiso::all();
        return response()->json($permisos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermisoRequest $request)
    {
        $permiso = new Permiso();
        $permiso->fill($request->all());
        $permiso->FechaRegistro = Carbon::now();
        $permiso->FechaModificado = Carbon::now();
        return response()->json(['message'=>'Permiso agregado'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(PermisoRequest $request, Permiso $permiso)
    {
        $permiso->fill($request->all());
        $permiso->FechaModificado = Carbon::now();
        $permiso->save();
        return response()->json(['message'=>'Permiso actualizado'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permiso $permiso)
    {
        //
    }
}
