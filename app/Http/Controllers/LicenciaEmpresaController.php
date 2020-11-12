<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenciaEmpresaRequest;
use App\Models\LicenciaEmpresa;
use App\Models\Usuario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
/**
 * GET
 * POST
 * UPDATE
 * ELIMIT
 */
/***
 * Controlador que se relaciona con la entidad licencia_empresa
 *  => Licencias por empresa
 */
class LicenciaEmpresaController extends Controller
{
    public function __construct()
    {
		// $this->authorizeResource(LicenciaEmpresa::class);
    }
    /**
     * Display a listing of the resource.
     * @Auth  {Ususario} checa si pertenece a algun municipio
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha = date('Y');
        if(Auth::user()->hasMunicipio()){
            $licencias_empresa = LicenciaEmpresa::where('IdEnlaceMunicipal', '=', Auth::user()->enlace->id)->orderBy('FechaCreacion', 'desc')->paginate(10);
        }else{
            $licencias_empresa = LicenciaEmpresa::where('Year', '=', $fecha)->orderBy('FechaCreacion', 'desc')->paginate(10);					
        }
           
        return response()->json($licencias_empresa, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LicenciaEmpresaRequest $request)
    {
        $usuario = $request->IdUsuario = 5;
        LicenciaEmpresa::create($request->all());
        return response()->json(['message' => 'Registro agregado'], 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LicenciaEmpresa  $licenciaEmpresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, LicenciaEmpresa $captura)
    {
        Gate::authorize("update", $captura);
        
        $captura->update($request->all());
        
        return response()->json(['message' => 'Se actualizo una nueva Licencia por Empresa'], 200,);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LicenciaEmpresa  $licenciaEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(LicenciaEmpresa $captura)
    {
        $captura->delete();
        return response()->json(['message' => 'Se ha eliminado una licencia'], 200);
    }

    /**
     * Consulta de entre dos fechas fechas 
     * @request year-month-day
     * @return \Illuminate\Http\Response
     */

    public function rangoFecha(Request $request){
        $dataInicial = Date($request->fecha_inicio);
        $dataFinal = Date($request->fecha_fin);
        
        $lista = LicenciaEmpresa::whereBetween('FechaCreacion', [$dataInicial, $dataFinal])->paginate(10);

        return response()->json($lista, 200);
  }
}
