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
		// Permiso::create([
		// 	'nombre' => '',
		// 	'slug' => 'usuario.index',
		// 	'descripcion' => '',
		// ]);   
		// Permiso::create([
		// 	'nombre' => '',
		// 	'slug' => 'usuario.update',
		// 	'descripcion' => '',
		// ]);   
		// Permiso::create([
		// 	'nombre' => '',
		// 	'slug' => 'captura.index',
		// 	'descripcion' => '',
		// ]);   
		// Permiso::create([
		// 	'nombre' => '',
		// 	'slug' => 'captura.own.index',
		// 	'descripcion' => '',
		// ]);   

		// Permisos para subir archivos o ver archivos subidos 
		// Permiso::create([
		// 	'nombre' => 'puede generar archivo',
		// 	'slug' => 'documento.generate',
		// 	'descripcion' => 'Generar archivo que ha guardado en captura por empresa',
		// ]); 
		// Permiso::create([
		// 	'nombre' => 'puede subir archivo',
		// 	'slug' => 'documento.store',
		// 	'descripcion' => 'Puede subir documentos firmados',
		// ]); 
		// Permiso::create([
		// 	'nombre' => 'puede ver sus propios archivos',
		// 	'slug' => 'documento.own.show',
		// 	'descripcion' => 'Puede ver sus archivos que el usuario ha subido',
		// ]);
		// Permiso::create([
		// 	'nombre' => 'puede ver sus todos los archivos',
		// 	'slug' => 'documento.show',
		// 	'descripcion' => 'Puede ver todos los archivos',
		// ]);
		// Permiso::create([
		// 	'nombre' => 'puede actualizar sus propios archivos',
		// 	'slug' => 'documento.own.update',
		// 	'descripcion' => 'Puede actualizar sus archivos que el usuario ha subido',
		// ]);
	}
}
