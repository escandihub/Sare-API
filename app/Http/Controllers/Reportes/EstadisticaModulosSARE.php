<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Licencia;
use App\Http\Requests\EstadisticaRequest;
use PDF;

class EstadisticaModulosSARE extends Controller
{
	/**
	 * The query going to return the array of query
	 * result to  make a document
	 * @return query result
	 */
	public function documento(EstadisticaRequest $request)
	{
        $modulos = $this->queryModuloSARE("Enero", "2019");
        $pdf = PDF::loadView("pdfs.modulo_estadistica", compact("modulos"));
		return $pdf->download("modulo_estadistica.pdf");
    }
    
	final public function queryModuloSARE($month, $year)
	{
		$estadistica_captura = Licencia::leftjoin(
			"catalogoenlaces",
			"totales_licencias.IdEnlaceMunicipal",
			"=",
			"catalogoenlaces.id"
		)
			->where([
				["totales_licencias.Mes", "=", $month],
				["totales_licencias.Year", "=", $year],
			])
			->groupBy("catalogoenlaces.Enlace_Municipal")
			->select(
				DB::raw("
				SUM(totales_licencias.Licencias_Emitidas) AS licencias,
				SUM(totales_licencias.Empleos_Generados) AS empleos,
				SUM(totales_licencias.Inversion_Generada) AS inversion,
				SUM(totales_licencias.No_Asesorias) AS asesorias,
				catalogoenlaces.Enlace_Municipal AS municipio
				")
			)
			->get();

		return $estadistica_captura;
	}
}
