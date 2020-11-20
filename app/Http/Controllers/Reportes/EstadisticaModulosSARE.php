<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Licencia;

class EstadisticaModulosSARE extends Controller
{
	/**
	 * The query going to return the array of query
	 * result to  make a document
	 * @return query result
	 */
	public function documento()
	{
		$opereation_module = $this->queryModuloSARE("Enero", "2019");
		dd($opereation_module);
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
