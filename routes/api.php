<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\EnlaceController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\LicenciaEmpresaController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('enlaces', EnlaceController::class);
Route::apiResource('licencias', LicenciaController::class);
Route::apiResource('permisos',PermisoController::class);
Route::apiResource('capturas',LicenciaEmpresaController::class);
Route::apiResource('usuarios',UsuarioController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
