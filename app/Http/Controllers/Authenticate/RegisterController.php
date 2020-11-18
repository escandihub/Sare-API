<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
	public function register(UsuarioRequest $request)
	{
		$usuario = Usuario::create($request->all());

		$usuario->Password = Hash::make($request->password);
		$usuario->save();

		return response()->json(
			[
				"message" => "Usuario creado con exito",
				"usuario" => $usuario,
			],
			200
		);
	}
}
