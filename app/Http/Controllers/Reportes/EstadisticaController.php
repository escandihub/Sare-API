<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LicenciaEmpresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

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
	public function generarReporte()
	{
		$empresas = $this->indicadorGeneralReporte("Enero", "2019");

		$doc = PDF::loadView("pdfs.empresas", compact("empresas"));
		
		return $pdf->download("estadistica_empresa.pdf");
	}
	/**
	 * The query going to return the array of query
	 * result to  make a document
	 * @return query result
	 */
	final public function indicadorGeneralReporte($month, $year)
	{
		$estadistica_captura = LicenciaEmpresa::leftjoin(
			"catalogoenlaces",
			"licencias_empresa.IdEnlaceMunicipal",
			"=",
			"catalogoenlaces.id"
		)
			->where([
				["licencias_empresa.Mes", "=", $month],
				["licencias_empresa.Year", "=", $year],
			])
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
