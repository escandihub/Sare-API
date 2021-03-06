<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;
/**
 * @api
 */
class ReporteController extends Controller
{
	const LICENCIA = "App\Models\LicenciaEmpresa";
	const EMPRESA = "App\Models\Licencia";

	public function capturas(Request $request)
	{
		
		$validatedData = $request->validate([
			"fecha_inicio" => "required",
			"fecha_fin" => "required",
		]);

		\Gate::authorize('hasRole', 'enlace');
		$capturas = $this->findByMonth(
			self::LICENCIA,
			$request->fecha_inicio,
			$request->fecha_fin
		);

		// \Log::alert('fecha 1 ' . $request->fecha_inicio . " fecha 2 " .  $request->fecha_fin);
		// \Log::info(count($capturas));
		// $capturas = $this->findByMonth(self::LICENCIA, "2019-10-01", "2019-10-03");
		if (false) {
			
			// dd($capturas->municipio->Enlace_Municipal);
			$nombre = \Auth::user()->nombre;
			$pdf = PDF::loadView(
				"pdfs.captura",
				compact("capturas", "usuario")
			)->setPaper("letter", "landscape");
			return $pdf->output();
		} else {
			return response()->json(
				[
					"message" => "No se encontrar datos con el criterio de busqueda",
					"status" => false,
				],
				404
			);
		}

		//return $pdf->stream('archivo.pdf');
	}

	/**
	 * este metodo no se implementa
	 * ya que en los requisitos no es solicitado
	 *
	 * @param Type $var
	 * @return void
	 */
	public function licencias(Type $var = null)
	{
		\Gate::authorize('hasRole', 'enlace');
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
		$licencia_captura->where("IdEnlaceMunicipal", "=", Auth::user()->enlace->id); // 
		return $licencia_captura
			->whereBetween("FechaCreacion", [$inicio, $fin])
			->with("municipio")
			->orderBy("FechaCreacion", "desc")
			->get();
	}
}
