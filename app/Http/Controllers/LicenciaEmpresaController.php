<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenciaEmpresaRequest;
use App\Models\LicenciaEmpresa;
use Illuminate\Http\Request;

class LicenciaEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LicenciaEmpresaRequest $request)
    {
        $licenciaEmpresa = new LicenciaEmpresa();
        $licenciaEmpresa->fill($request->all());
        return response()->json(['message' => 'Registro agregado'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LicenciaEmpresa  $licenciaEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show(LicenciaEmpresa $licenciaEmpresa)
    {     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LicenciaEmpresa  $licenciaEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LicenciaEmpresa $licenciaEmpresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LicenciaEmpresa  $licenciaEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(LicenciaEmpresa $licenciaEmpresa)
    {
        //
    }
}
