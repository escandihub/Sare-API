<?php

namespace App\Http\Controllers\Rules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CierreCaptura;

class CierreCapturaController extends Controller
{
    /**
     * This controller checks if the municipalities 
     * are on an available date to save data
     * @api api/canCreate
		 * @return boolean 
     */
	public function index()
	{
		$cierre = CierreCaptura::findOrFail(1);

		$now =  new \DateTime(date("Y-m-d"));
        $fin =  new \DateTime($cierre->fecha_final);
        
		if ($fin >= $now ) {
			return response()->json(["can" => true], 200);
		} else {
			return response()->json(["can" => false], 200);
		}
	}
}
