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

use App\Models\Usuario;
use App\Models\Permiso;
use App\Models\Grupo;
use Illuminate\Support\Facades\Gate;
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
    
    Route::apiResource('permisos',PermisoController::class);
    
    Route::apiResource('grupos',GrupoController::class);
    Route::apiResource('bitacoras',BitacoraController::class);
    
    Route::get('bitacora_detalles',[BitacoraDetallesController::class,'fechas']);
    Route::get('bitacora_all',[BitacoraDetallesController::class,'index']);
    

    
    
    //Upload a file 
    Route::post('upload_file', [DocumentController::class, 'store']); 
});

Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => ['api']], function () {
    
    Route::get('/prueba', function () {
        return '0';
    });
});
Route::apiResource('capturas',LicenciaEmpresaController::class);
Route::apiResource('licencias', LicenciaController::class);
Route::get('licencia/per_dates',[LicenciaController::class,'rangoFecha'])->name('licencias.per-dates');
Route::get('captura/per_date',[LicenciaEmpresaController::class,'porFechas'])->name("capturas.per-dates");
Route::get('/test', function () {

      $grupo =  Grupo::find(1);
      $grupo->permisos()->sync([1,2]);
      return '0';
    //   return $grupo->permisos;
    // $usuario = Usuario::find(1);
    // return $usuario->tienePermiso;
    // $usuario = Usuario::with('grupo')->orderBy('id', 'Desc')->get();
    
     $usuario = Usuario::find(1);
    // $valor =  $usuario->tienePermiso('usuario.update');
    if($usuario->propietario()){
        return 'es propietario total';
    }else{
        return 'no lo es';
    }
    return Usuario::find(1)->propietario('captura.index');
    Gate::authorize('tiene-acceso', 'usuario.update');
    
    // return $usuario->grupo()->permisos;
    // return $usuario->tienePermiso('usuario.index');
        
    
    });