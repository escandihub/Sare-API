<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use Illuminate\Http\Request;
use App\Http\Requests\LicenciaRequest;
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
        $licencias = Licencia::where('Year', '=', $fecha)->with('municipio')->paginate(12);
        return response()->json($licencias, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LicenciaRequest $request)
    {
        // $request->municipio 
        // $request->month 
         $indicador = Licencia::create($request->all());
         $indicador->IdUsuario = 5;
         $indicador->MesConcluido = 0;
         $indicador->save();

        return response()->json(["message" => "Se ha agreado un Nuevo indicador"], 201);
    }


    /**
     * Update the specified resource in storage.
     * @param route $identificador
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function update(LicenciaRequest $request, Licencia $licencia)
    {
        $licencia->update($request->all());
        return response()->json([
            'menssage' => 'Actualizacion con exito',
            'licencia' => $licencia
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licencia $licencia)
    {
        $licencia->delete();
        return response()->json(['message' => 'Se ha Eliminado'], 200);
    }

    /**
     * Consulta de entre dos fechas fechas 
     * @request year-month-day
     * @return \Illuminate\Http\Response
     */

     public function rangoFecha(Request $request){
           $dataInicial =  Date($request->fechaIncial);
           $dataFinal =  Date($request->fechaFinal);

           $lista = Licencia::whereBetween('FechaCreacion', [$dataInicial, $dataFinal])->get();

        return response()->json($lista, 200);
    }
}
