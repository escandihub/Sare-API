<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LicenciaEmpresa;

use PDF;
class CapturaReporteController extends Controller
{
	public function documento(Type $var = null)
	{
		$capturas = $this->findData("2019-10-01", "2019-11-30");
		// dd($capturas);
		$pdf = PDF::loadView("pdfs.captura", compact("capturas"))->setPaper(
			"letter",
			"landscape"
		);
		return $pdf->download("demo.pdf");
	}
	/**
	 * @param  date inicio
	 * @param  date fin
	 * @return QueryObject
	 */
	public function findData($inicio, $fin)
	{
		$licencia_captura = LicenciaEmpresa::query();
		$licencia_captura->where("IdEnlaceMunicipal", "=", 27); // Auth::user()->enlace->id
		return $licencia_captura
			->whereBetween("FechaCreacion", [$inicio, $fin])
			->with("municipio")
			->orderBy("FechaCreacion", "desc")
			->get();
	}
}
