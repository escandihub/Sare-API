<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\EnlaceController;
use App\Http\Controllers\PermisoController;

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
Route::resource('enlaces', EnlaceController::class);
Route::apiResource('licencia', LicenciaController::class);
Route::apiResource('permisos',PermisoController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
