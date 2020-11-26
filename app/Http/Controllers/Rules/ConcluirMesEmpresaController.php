<?php

namespace App\Http\Controllers\Rules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LicenciaEmpresa;

class ConcluirMesEmpresaController extends Controller
{
	/**
	 * Display a list a company licenses
     * on the actual month and year 
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$month = \Date("m");
		$year = \Date("Y");
		return $empresas = LicenciaEmpresa::whereRaw(
			"MONTH(FechaCreacion) = ? AND YEAR(FechaCreacion) = ?",
			[$month, $year]
		)
			->with("municipio")
			->selectRaw(
				"DISTINCT licencias_empresa.IdEnlaceMunicipal, licencias_empresa.MesConcluido"
			)
			->orderBy("IdEnlaceMunicipal", "DESC")
			->get();
	}

	/**
	 * Update the close captura 
     * when if in the current month 
     * going to run very well
     * if want to set another month with other year
     * it's no supported yet, be carefull 
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$month = \Date("m");
		$year = \Date("Y");

		foreach ($request->all() as $key => $value) {
			LicenciaEmpresa::where("IdEnlaceMunicipal", $value["IdEnlaceMunicipal"])
				->where("Year", $year)
				->where("Mes", $month)
				->update(["MesConcluido" => $value["MesConcluido"]]);
		}
		return response()->json(["message" => "OK"], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
