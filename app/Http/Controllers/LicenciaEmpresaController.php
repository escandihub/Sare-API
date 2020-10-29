<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenciaEmpresaRequest;
use App\Models\LicenciaEmpresa;
use Illuminate\Http\Request;
/**
 * GET
 * POST
 * UPDATE
 * ELIMIT
 */
class LicenciaEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha = data('Y');
        $licencias = LicenciaEmpresa::where('Year', '=', $fecha);
        return response()->json($licencias, 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LicenciaEmpresa  $licenciaEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LicenciaEmpresa $licenciaEmpresa)
    {
        $licenciaEmpresa->update($request->all());
        
        return response()->json(['menssage' => 'Se Agrego una nueva Licencia por Empresa'], 200,);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LicenciaEmpresa  $licenciaEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(LicenciaEmpresa $licenciaEmpresa)
    {
        $licenciaEmpresa->delete();
        return response()->json(['message' => 'Se ha eliminado una licencia'], 200);
    }

    /**
     * Consulta de entre dos fechas fechas 
     * @return \Illuminate\Http\Response
     */

    public function rangoFecha(Request $request){
        $dataInicial = DateTime($request->fechaIncial);
        $dataFinal = DateTime($request->fechaFinal);

        $lista = LicenciaEmpresa::whereBetween('FechaCreacion', [$dataInicial, $dataFinal]);

        return response()->json($lista, 200);
  }
}
