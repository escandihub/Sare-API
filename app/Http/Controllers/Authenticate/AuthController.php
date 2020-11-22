<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

use App\Models\Grupo;

class AuthController extends Controller
{
	//
	public function login(Request $request)
	{
		$validatedData = $request->validate([
			"usuario" => "required",
			"password" => "required",
		]);

		$input = $request->only("usuario", "password");
		$jwt_token = null;
		if (!($jwt_token = Auth::attempt($input))) {
			return response()->json(
				[
					"titulo" => "Credenciales invalidas",
					"message" => "Correo o contraseña no válidos.",
				],
				404
			);
		}
		$usuario = Auth::user()->grupo()->pluck("grupo_id");
		$grupo = Grupo::find($usuario)->first();
		$rutas = $grupo->getRutas();

		return response()->json([
			"token" => $jwt_token,
			"profile" => Auth::user(),
			"routes" => $rutas
		]);
	}

	public function logout()
	{
		Auth::logout();
	}

	public function habilidades()
	{
		if (Auth::check()) {
			$data = ["shit", "shot", "shit", "shot"];
			return response()->json($data, 200);
		}else{
			return response()->json([
				"menssage" => "Hey, where do you wanna go?, huh?"
			], 200);
		}
	}

	public function resetPassword(Request $request){
		$validation = $request->validate([
			"oldPassword" => "required",
			"password" => ["required", "same:password_confirmed"]
		]); 
			$usuario = Auth::user();
		if(!\Hash::check($request->oldPassword, Auth::user()->password)){
		 return response()->json(["message" => "La contraseña actual es incorrecta"], 422);
		}
		$usuario->password = \Hash::make($request->password);
		$usuario->save();

		return response()->json([
			"message" => "Contraseña actualizada"
		], 201);
	}

	public function resetUsersPassword(Request $request){
		$validation = $request->validate([
			"id" => "required",
			"password" => ["required", "same:password_confirmed"]
		]); 	
		if (Gate::allows('tiene-acceso', "full-access")) {
			$usuario = Usuario::findOrFail($request->id); 
			$usuario->password = \Hash::make($request->password);
			$usuario->save();

			return response()->json([
				"message" => "Contraseña actualizada"
			], 201);
	}else{
	return response()->json(["message" => "privilegios insuficientes"], 403);
	/**
	 * I don't know why is a reponse a 401 error code the gate tries to redirect to a anunthenticate page 
	 */
	// throw new AuthorizationException('Solo un Administrador pude realizar esta operacion.');
	
	}
}
}