<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use PDF;

/**
 * @api
 */
class ReporteController extends Controller
{
	const LICENCIA = "App\Models\LicenciaEmpresa";
	const EMPRESA = "App\Models\Licencia";

	public function capturas(Type $var = null)
	{
		$capturas = $this->findByMonth(self::LICENCIA, "2019-10-01", "2019-10-02");
		// dd($capturas);
		$pdf = PDF::loadView("pdfs.captura", compact("capturas"))->setPaper(
			"letter",
			"landscape"
		);
		return $pdf->download("demo.pdf");
	}

	public function licencias(Type $var = null)
	{
		$licencias = $this->findByMonth(self::EMPRESA, "2019-10-01", "2019-10-05");
		// dd($capturas);
		$pdf = PDF::loadView("pdfs.licencias", compact("licencias"))->setPaper(
			"letter",
			"landscape"
		);
		return $pdf->download("demo.pdf");
	}

	/**
	 * @param  date start date month
	 * @param  date end date month
	 * @param  Model
	 * @return Array  of mysql result
	 */
	public function findByMonth($modelo, $inicio, $fin)
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
