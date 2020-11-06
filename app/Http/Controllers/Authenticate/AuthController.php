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

        $input = $request->only('Usuario', 'Password');
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
}