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
		Permiso::create([
			'nombre' => '',
			'slug' => 'usuario.index',
			'descripcion' => '',
		]);   
		Permiso::create([
			'nombre' => '',
			'slug' => 'usuario.update',
			'descripcion' => '',
		]);   
		Permiso::create([
			'nombre' => '',
			'slug' => 'captura.index',
			'descripcion' => '',
		]);   
		Permiso::create([
			'nombre' => '',
			'slug' => 'captura.own.index',
			'descripcion' => '',
		]);   
	}
}
