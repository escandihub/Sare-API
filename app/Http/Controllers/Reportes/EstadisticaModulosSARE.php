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
	 *
	 * [table totales_licencia]
	 * @return query result
	 */
	// public function documento(EstadisticaRequest $request)
	public function documento(Request $request)
	{
		\Gate::authorize("tiene-acceso", "documento.estadistica");
		$modulos = $this->queryModuloSARE(
			$request->fecha_inicio,
			$request->fecha_fin
		);
\Log::alert($modulos->count() > 0);
\Log::alert(empty($modulos));
		if (count($modulos) > 0) {
			\Log::alert('entrea');
			$fecha = $request->fecha_inicio;
			$fecha_fin = $request->fecha_fin;
			$author = \Auth::user()->nombre;
			$pdf = PDF::loadView("pdfs.modulo_estadistica", compact("modulos", "fecha", "fecha_fin", "author"));
			return $pdf->download("modulo_estadistica.pdf");
		}else{
			$header = ['Content-Type: application/json'];
			return response()->json(['message' => "No se encontraron datos cone ese criterio"], 404, $header);
		}
	}

	final public function queryModuloSARE($inicio, $fin)
	{
		$estadistica_captura = Licencia::leftjoin(
			"catalogoenlaces",
			"totales_licencias.IdEnlaceMunicipal",
			"=",
			"catalogoenlaces.id"
		)
			// ->where([
			// 	["totales_licencias.Mes", "=", $month],
			// 	["totales_licencias.Year", "=", $year],
			// ])
			->whereBetween("FechaCreacion", [$inicio, $fin])
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
