<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Enlace;
use Validator, Redirect, Response, File;
use App\Http\Requests\DocumentRequest;

class DocumentController extends Controller
{
	public function store(DocumentRequest $request)
	{
		// return response()->json(['archivo' =>  $request->all()], 200);
		if ($files = $request->file("file")) {
			$enlace_municipal = Enlace::find(21);

			//Formato para el archivo a salvar
			$to_lowe_case = strtolower($enlace_municipal->Enlace_Municipal);
			$string = preg_replace("/[^a-z0-9_\s-]/", "", $to_lowe_case);
			$string = preg_replace("/[\s-]+/", " ", $string);
			$string = preg_replace("/[\s_]/", "_", $string);
			$fecha = Date("d-m-Y");

			$nombre_archivo =
				$string . "_" . $fecha . "." . $request->file->extension();

			Documento::create([
				"titulo" => $nombre_archivo,
				"usuario_id" => 2,
			]);
			$request->file->move(public_path("uploads"), $nombre_archivo);
			// $request->file->move(public_path('uploads'), '.png');
		}

		return response()->json(["message" => "Se ha creado el"], 201);
	}
}
/*
$to_lowe_case = strtolower($enlace_municipal->Enlace_Municipal);
            $enlace  = str_replace(" ", "_", $to_lowe_case);
            $fecha = Date('d-m-Y');

*/
