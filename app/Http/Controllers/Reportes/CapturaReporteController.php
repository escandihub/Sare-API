<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Licencia;

use PDF;
class CapturaReporteController extends Controller
{

    public function documento(Type $var = null)
    {
        $pdf = PDF::loadView('pdfs.captura');    
        return $pdf->download('demo.pdf');
    }
	/**
	 * @param  date inicio
	 * @param  date fin
	 * @return QueryObject
	 */
	public function findData($inicio, $fin)
	{
        $licencia_captura = Licencia::query();
		$licencia_captura->where("IdEnlaceMunicipal", "=", 27); // Auth::user()->enlace->id
		$licencia_captura
			->whereBetween("FechaCreacion", [$inicio, $fin])
			->with("municipio")
			->orderBy("FechaCreacion", "desc")->get();
	}
}
