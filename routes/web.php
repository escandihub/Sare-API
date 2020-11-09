<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinglePageController;

use App\Models\Usuario;
use App\Models\Permiso;
use App\Models\Grupo;
use Illuminate\Support\Facades\Gate;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any}',[SinglePageController::class,'index'])->where('any', '.*');

Route::get('/prueba', function () {
  $usuario = Usuario::find(1);
// $valor =  $usuario->tienePermiso('usuario.update');

Gate::authorize('tiene-acceso');
return $usuario;
    
});