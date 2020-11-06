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
        $input = $request->only('usuario', 'password');
        
        if (Auth::attempt($input)) {
            return  response()->json([
                'profile' => Auth::user()
            ]);
        }        
        return  response()->json([
            'titulo' => 'Credenciales invalidas',
            'message' => 'Correo o contraseña no válidos.',
        ], 404);

    }
}
