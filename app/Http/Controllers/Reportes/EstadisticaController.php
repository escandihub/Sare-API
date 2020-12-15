<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LicenciaEmpresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\EstadisticaRequest;
use PDF;
class EstadisticaController extends Controller
{
	/**
	 * Genrate a statistics from  in PDF format
	 * operation by companies
	 * @table licencias_empresa
	 * @SPA capturas por empresa
	 * @view Reportes
	 * another name that take this operation
	 * Indicadores de Operación por Empresas en los Módulos SARE del Mes de Enero
	 */
	public function documento(EstadisticaRequest $request)
	{
		$empresas = $this->indicadorGeneralReporte($request->fecha_inicio, $request->fecha_fin);
		$fecha = $request->fecha_inicio;
		$fecha_fin = $request->fecha_fin;
		$author = \Auth::user()->nombre;
		$doc = PDF::loadView("pdfs.empresas", compact("empresas", "fecha", "fecha_fin", "author"));
		
		return $doc->download("estadistica_empresa.pdf");
	}
	/**
	 * The query going to return the array of query
	 * result to  make a document
	 * @return query result
	 */
	final public function indicadorGeneralReporte($inicio, $fin)
	{
		$estadistica_captura = LicenciaEmpresa::leftjoin(
			"catalogoenlaces",
			"licencias_empresa.IdEnlaceMunicipal",
			"=",
			"catalogoenlaces.id"
		)
			// ->where([
			// 	["licencias_empresa.Mes", "=", $month],
			// 	["licencias_empresa.Year", "=", $year],
			// ])
			->whereBetween("FechaCreacion", [$inicio, $fin])
			->groupBy("catalogoenlaces.Enlace_Municipal")
			->select(
				DB::raw("
				SUM(licencias_empresa.Inversion) AS inversion,
				SUM(licencias_empresa.No_Empleo) AS empleos,
				COUNT( DISTINCT(licencias_empresa.Empresa)) AS empresas,
				catalogoenlaces.Enlace_Municipal AS municipio
				")
			)
			->get();

		return $estadistica_captura;
	}
}
