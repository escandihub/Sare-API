<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Grupo;

class abilitiesController extends Controller
{
	public function index()
	{
		if (Auth::check()) {
			$current_user = Auth::user();
			$abilities = $current_user->habilidades();
			$usuario = $current_user->grupo()->pluck("grupo_id");
			$grupo = Grupo::find($usuario)->first();
            $rutas = $grupo->getRutas();
            
			return response()->json(
				[
					"abilities" => $abilities,
					"routes" => $rutas,
					"profile" => $current_user,
				],
				200
			);
		}
	}
}
