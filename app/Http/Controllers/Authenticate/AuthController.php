<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
      $validatedData = $request->validate([
        'usuario' => 'required',
        'password' => 'required',
    ]);

        $input = $request->only('usuario', 'password');
        $jwt_token = null;
        if (!$jwt_token = Auth::attempt($input)) {

            return  response()->json([
                'titulo' => 'Credenciales invalidas',
                'message' => 'Correo o contraseña no válidos.',
            ], 404);
        }

        return  response()->json([
            'token' => $jwt_token,
            'profile' => Auth::user()
        ]);


    }

     public function logout()
    {
        Auth::logout();
    }
}
