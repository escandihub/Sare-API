<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Enlace;
use Validator, Redirect, Response, File;
use App\Http\Requests\DocumentRequest;

use Illuminate\Support\Str;
use App\Http\Controllers\Traits\helper;

class DocumentController extends Controller
{
	use helper;
	public function store(DocumentRequest $request)
	{
		// return response()->json(['archivo' =>  $request->all()], 200);
		// return (string) Str::uuid();
		// (string) Str::orderedUuid();
		if ($files = $request->file("file")) {
			$enlace_municipal = Enlace::find(21);

			//Formato para el archivo a salvar
			$municipio = $this->convertStringToUnderscore(
				$enlace_municipal->Enlace_Municipal
			);

			$today = Date("d-m-Y");

			$nombre_archivo =
				$municipio . "_" . $today . "." . $request->file->extension();

			Documento::create([
				"titulo" => $nombre_archivo,
				"uuid" => (string) Str::orderedUuid(),
				"municipio_id" => $enlace_municipal->id,
			]);
			$request->file->move(
				public_path("uploads/" . $municipio),
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
		return $folder_name = $this->replaceSpecialCharacters($file->municipio->Enlace_Municipal);
		$path = public_path("uploads/" . $folder_name . "/" . $file->titulo);
		// return $path = storage_path($file->titulo);

		return Response::make(file_get_contents($path), 200, [
			"Content-Type" => "application/pdf",
			"Content-Disposition" => 'inline; filename="' . $file->titulo . '"',
		]);
	}
}
