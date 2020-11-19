<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PDF;
class ReporteController extends Controller
{
	public function capturas(Type $var = null)
	{
		$capturas = $this->find_by_month( "App\Models\LicenciaEmpresa", "2019-10-01", "2019-10-05");
		// dd($capturas);
		$pdf = PDF::loadView("pdfs.captura", compact("capturas"))->setPaper(
			"letter",
			"landscape"
		);
		return $pdf->download("demo.pdf");
	}

	public function licencias(Type $var = null)
	{
		$licencias = $this->find_by_month("App\Models\Licencia", "2019-10-01", "2019-10-05");
		// dd($capturas);
		$pdf = PDF::loadView("pdfs.licencias", compact("licencias"))->setPaper(
			"letter",
			"landscape"
		);
		return $pdf->download("demo.pdf");
	}

	/**
	 * @param  date inicio
	 * @param  date fin
	 * @param  Model fin
	 * @return QueryObject
	 */
	public function find_by_month($modelo, $inicio, $fin)
	{
		$licencia_captura = $modelo::query();
		$licencia_captura->where("IdEnlaceMunicipal", "=", 27); // Auth::user()->enlace->id
		return $licencia_captura
			->whereBetween("FechaCreacion", [$inicio, $fin])
			->with("municipio")
			->orderBy("FechaCreacion", "desc")
			->get();
	}

}
