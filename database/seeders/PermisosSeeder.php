<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Permiso;
class PermisosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//administracion de usuarios
		Permiso::create([
			"nombre" => "",
			"slug" => "usuario.index",
			"descripcion" => "",
		]);
		Permiso::create([
			"nombre" => "",
			"slug" => "usuario.update",
			"descripcion" => "puede actualizar a cualquier usuario",
		]);
		Permiso::create([
			"nombre" => "",
			"slug" => "usuario.delete",
			"descripcion" => "Puede eliminar a cualquier usuario",
		]);
		//grupos y privilegios
		Permiso::create([
			"nombre" => "grupos y privilegios",
			"slug" => "grupo.index",
			"descripcion" => "Puede ver los grupos",
		]);
		Permiso::create([
			"nombre" => "grupos y privilegios",
			"slug" => "grupo.update",
			"descripcion" => "Puede actualizar los privilegios del los grupos",
		]);
		Permiso::create([
			"nombre" => "grupos y privilegios",
			"slug" => "grupo.delete",
			"descripcion" => "Puede eliminar los grupos",
		]);
		//rutas de acceso
		Permiso::create([
			"nombre" => "Acceso a rutas",
			"slug" => "rutas.index",
			"descripcion" => "Puede ver la lista de rutas",
		]);
		Permiso::create([
			"nombre" => "Acceso a rutas",
			"slug" => "rutas.show",
			"descripcion" => "Puede ver la lista de rutas de cada grupo",
		]);
		Permiso::create([
			"nombre" => "Acceso a rutas",
			"slug" => "rutas.update",
			"descripcion" => "Puede actualizar las rutas de los grupos",
		]);
		//Bitacora 
		Permiso::create([
			"nombre" => "Bitacora",
			"slug" => "bitacora.index",
			"descripcion" => "Puede ver la lista de bitacoras",
		]);
		// Captura por empresa
		Permiso::create([
			"nombre" => "Captura por empresa",
			"slug" => "captura.index",
			"descripcion" => "Puede ver las lista de las capturas",
		]);
		Permiso::create([
			"nombre" => "Captura por empresa",
			"slug" => "captura.update",
			"descripcion" => "puede editar las capturas",
		]);
		Permiso::create([
			"nombre" => "Captura por empresa",
			"slug" => "captura.delete",
			"descripcion" => "puede eliminar las capturas",
		]);
		// Indicador general
		Permiso::create([
			"nombre" => "Indicador general",
			"slug" => "indicador.index",
			"descripcion" => "Puede ver las lista de los indicadores",
		]);
		Permiso::create([
			"nombre" => "indicador general",
			"slug" => "indicador.update",
			"descripcion" => "puede editar las indicadores",
		]);
		Permiso::create([
			"nombre" => "indicador general",
			"slug" => "indicador.delete",
			"descripcion" => "puede eliminar los indicadores",
		]);
		// Permisos para subir archivos o ver archivos subidos
		Permiso::create([
			"nombre" => "Gestion de documentos",
			"slug" => "documento.generate",
			"descripcion" => "Generar archivo que ha guardado en captura por empresa",
		]);
		Permiso::create([
			"nombre" => "Gestion de documentos",
			"slug" => "documento.store",
			"descripcion" => "Puede subir documentos firmados",
		]);
		Permiso::create([
			"nombre" => "Gestion de documentos",
			"slug" => "documento.own.show",
			"descripcion" => "Puede ver sus archivos que el usuario ha subido",
		]);
		Permiso::create([
			"nombre" => "Gestion de documentos",
			"slug" => "documento.show",
			"descripcion" => "Puede ver todos los archivos subidos",
		]);
		Permiso::create([
			"nombre" => "Gestion de documentos",
			"slug" => "documento.own.update",
			"descripcion" => "Puede actualizar sus archivos que el usuario ha subido",
		]);
	}
}

// Permiso::create([
// 	"nombre" => "",
// 	"slug" => "usuario.own.update",
// 	"descripcion" => "Puede actualizar su propio usuario",
// ]);
