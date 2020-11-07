<?php

use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\BitacoraDetallesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\EnlaceController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\LicenciaEmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Authenticate\AuthController;
use App\Http\Controllers\Authenticate\RegisterController;

use App\Http\Controllers\Authenticate\AuthController;
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
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('usuarios',UsuarioController::class);
    Route::apiResource('enlaces', EnlaceController::class);
    Route::apiResource('licencias', LicenciaController::class);
    Route::apiResource('permisos',PermisoController::class);
    Route::apiResource('capturas',LicenciaEmpresaController::class);
    Route::apiResource('grupos',GrupoController::class);
    Route::apiResource('bitacoras',BitacoraController::class);
    
    Route::get('bitacora_detalles',[BitacoraDetallesController::class,'fechas']);
    Route::get('bitacora_all',[BitacoraDetallesController::class,'index']);
    
    Route::get('licencias_fechas',[LicenciaController::class,'rangoFecha']);
    Route::get('capturas_fechas',[LicenciaEmpresaController::class,'rangoFecha']);
    
    //Upload a file 
    Route::post('upload_file', [DocumentController::class, 'store']); 
});

Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => ['api']], function () {
    
    Route::get('/prueba', function () {
        return '0';
    });
});