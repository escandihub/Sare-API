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
use App\Http\Controllers\Authenticate\abilitiesController;

use App\Http\Controllers\Reportes\ReporteController;
use App\Http\Controllers\Reportes\EstadisticaController;
use App\Http\Controllers\Reportes\EstadisticaModulosSARE;

use App\Http\Controllers\Rules\CierreCapturaController;
use App\Http\Controllers\Rules\CierreCapturaFechasController;
use App\Http\Controllers\Rules\ConcluirMesEmpresaController;
use App\Http\Controllers\RutasController;


use App\Models\Usuario;
use App\Models\Bitacora;
use App\Models\Permiso;
use App\Models\Grupo;
use App\Models\menu\Ruta;
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
//routes to be able to access views
Route::apiResource("rutas", RutasController::class);
Route::get("bitacoras/movimientos", [BitacoraController::class, "movimientos"]);
Route::group(["middleware" => ["auth:sanctum"]], function () {
	
	Route::apiResource("usuarios", UsuarioController::class);
	Route::apiResource("enlaces", EnlaceController::class);

	Route::apiResource("permisos", PermisoController::class);

	Route::apiResource("grupos", GrupoController::class);
	Route::apiResource("bitacoras", BitacoraController::class)->only(["index"]);
	

	Route::get("bitacora_detalles", [
		BitacoraDetallesController::class,
		"fechas",
	]);
	Route::get("bitacora_all", [BitacoraDetallesController::class, "index"]);

	//Upload a file
	
}); // end api protections 
Route::apiResource("files", DocumentController::class)->only(['store', 'index', 'show']);

Route::post("login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"]);
Route::post("/reset-password", [AuthController::class, "resetPassword"]);
Route::post("/reset-users-password", [
	AuthController::class,
	"resetUsersPassword",
]);

//endpoint generate pdf via dompPDF
Route::get("/capturas/documento", [ReporteController::class, "capturas"]); //enlaces
//super usuarios
Route::get("/estadistica/totales", [EstadisticaModulosSARE::class, "documento"]);
Route::get("/estadistica/por-empresa", [EstadisticaController::class, "documento"]);

Route::apiResource("canCreate", CierreCapturaController::class)->only(["index"]);
Route::apiResource("captura-fechas", CierreCapturaFechasController::class)->only(["index","update"]);

//set month finished
Route::resource('conclude-empresas', ConcluirMesEmpresaController::class)->only(["index", "store"]);

Route::group(["middleware" => ["api"]], function () {
	Route::get("/prueba", function () {
		return "0";
	});
});
Route::apiResource("capturas", LicenciaEmpresaController::class)->except("show");
Route::apiResource("licencias", LicenciaController::class);
Route::get("licencia/per_dates", [
	LicenciaController::class,
	"rangoFecha",
])->name("licencias.per-dates");
Route::get("captura/per_date", [
	LicenciaEmpresaController::class,
	"porFechas",
])->name("capturas.per-dates");
Route::get("/test", function () {
	$grupo = Grupo::find(1);
	$grupo->permisos()->sync([1, 2]);
	return "0";
	//   return $grupo->permisos;
	// $usuario = Usuario::find(1);
	// return $usuario->tienePermiso;
	// $usuario = Usuario::with('grupo')->orderBy('id', 'Desc')->get();

	$usuario = Usuario::find(1);
	// $valor =  $usuario->tienePermiso('usuario.update');
	if ($usuario->propietario()) {
		return "es propietario total";
	} else {
		return "no lo es";
	}
	return Usuario::find(1)->propietario("captura.index");
	Gate::authorize("tiene-acceso", "usuario.update");

	// return $usuario->grupo()->permisos;
	// return $usuario->tienePermiso('usuario.index');
});
// Route::get("/abilities", [AuthController::class, "habilidades"]);
Route::apiResource("abilities", abilitiesController::class)->only(["index"]);
Route::get("/habili", function () {
	$user = Usuario::findOrFail(2);
	// $user->grupo;

	return response()->json($user->habilidades(), 200);
});

Route::get("/rutas-test", function () {

	//ver mis rutas
	$grupo = Grupo::find(1);
	// $menu_ruta =  Ruta::find(1)->menu;

	return response()->json($grupo->getRutas(), 200);

	//savar nuevas rutas al grupo 
	$grupo = Grupo::find(1);
	$grupo->rutas()->sync([9,3,2,8]);

	return response()->json($grupo->getRutas(), 200);

	//optener rutas 
	$u = Usuario::findOrFail(2);

	$u->grupo()->pluck("grupo_id"); //id del grupo - usuario 
	$grupo = Grupo::find($u)->first();
return $grupo->getRutas();

/// estamos haciendo lo de optner rutas en el modelo Grupo
	// $usuario = Usuario::find(2);
	// $grupo = $usuario->grupo()->permisos();

});

Route::get('/ver/bitacora', function () {
	$bitacora = Bitacora::with("movimiento", "usuario")->get();

	return $bitacora;
});
