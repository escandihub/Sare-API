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
			$sin_caracteres = $this->replaceName($enlace_municipal->Enlace_Municipal);
			$to_lowe_case = strtolower($sin_caracteres);
			$string = preg_replace("/[^a-z0-9_\s-]/", "", $to_lowe_case);
			$string = preg_replace("/[\s-]+/", " ", $string);
			$string = preg_replace("/[\s_]/", "_", $string);
			$fecha = Date("d-m-Y");

			$nombre_archivo =
				$string . "_" . $fecha . "." . $request->file->extension();

			Documento::create([
				"titulo" => $nombre_archivo,
				"municipio_id" => $enlace_municipal->id,
			]);
			$request->file->move(
				public_path("uploads/" . $sin_caracteres),
				$nombre_archivo
			);
			// $request->file->move(public_path('uploads'), '.png');
		}

		return response()->json(["message" => "Se ha creado el"], 201);
	}

	public function index()
	{
		$municipio = Enlace::find(21); // san cristobal

		$documentos = Documento::where("municipio_id", "=", $municipio->id)->get();
		return $documentos;
	}

	public function show(Documento $file)
	{
		$clean_name = $this->replaceName($file->municipio->Enlace_Municipal);
		$path = public_path("uploads/" . $clean_name . "/" . $file->titulo);
		// return $path = storage_path($file->titulo);

		return Response::make(file_get_contents($path), 200, [
			"Content-Type" => "application/pdf",
			"Content-Disposition" => 'inline; filename="' . $file->titulo . '"',
		]);
	}

	public function replaceName($municipio)
	{
		$cadena = str_replace(
			["á", "é", "í", "ó", "ú"],
			["a", "e", "i", "o", "u"],
			$municipio
		);
		return $cadena;
	}
}
/*
$to_lowe_case = strtolower($enlace_municipal->Enlace_Municipal);
            $enlace  = str_replace(" ", "_", $to_lowe_case);
            $fecha = Date('d-m-Y');

*/
