<?php

namespace App\Http\Controllers\Rules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CierreCaptura;

class CierreCapturaController extends Controller
{
    /**
     * This controller check if the country
     * on date tu save data 
     * @api api/canCreate
     */
	public function index()
	{
		// $cierre = CierreCaptura::findOrFail(1);

		$now =  new \DateTime(date("Y-m-d"));
        $fin =  new \DateTime("2020-11-20");
        
		if ($fin < $now ) {
			return response()->json(["can" => true], 200);
		} else {
			return response()->json(["can" => false], 200);
		}
	}
}
