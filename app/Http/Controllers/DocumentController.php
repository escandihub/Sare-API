<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Enlace;
use Validator, Redirect, Response, File;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\helper;

use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
	use helper;
	public function store(DocumentRequest $request)
	{
		// return response()->json(['archivo' =>  $request->all()], 200);
		// return (string) Str::uuid();
		// (string) Str::orderedUuid();

		// if ($files = $request->file("file")) {
		\Gate::authorize("hasRole", "enlace"); // si es enlace
		\Gate::authorize("tiene-acceso", "documento.store"); //puede guardar?
		$enlace_municipal = Auth::user()->enlace;

		//Formato para el archivo a salvar
		$municipio = $this->convertStringToUnderscore(
			$enlace_municipal->Enlace_Municipal
		);
		$folder_name = $this->replaceSpecialCharacters(
			$enlace_municipal->Enlace_Municipal
		);
		$today = Date("d-m-Y");

		$nombre_archivo =
			$municipio . "_" . $today . "." . $request->file->extension();

		$existe = Documento::where("titulo", "=", $nombre_archivo)->get();

		if (!count($existe)) {
			Documento::create([
				"titulo" => $nombre_archivo,
				"uuid" => (string) Str::orderedUuid(),
				"municipio_id" => $enlace_municipal->id,
			]);
			$request->file->move(
				public_path("uploads/" . $folder_name),
				$nombre_archivo
			);

			return response()->json(["message" => "Se ha creado el"], 201);
		} else {
			return response()->json(
				["message" => "Ya se ha subido un documetos de este mes"],
				422
			);
		}
	}

	public function index()
	{
		if (\Gate::allows("tiene-acceso", "documento.show")) {
			$documentos = Documento::with('municipio')->get();
			return $documentos;
		} else {
			\Gate::authorize("tiene-acceso", "documento.own.show");
			$documentos = Documento::where(
				"municipio_id",
				"=",
				Auth::user()->enlace->id
			)->with('municipio')->get();
			return $documentos;
		}
	}

	public function show(Documento $file)
	{
		$folder_name = $this->replaceSpecialCharacters(
			$file->municipio->Enlace_Municipal
		);
		$ruta = "uploads/" . $folder_name . "/" . $file->titulo;
		$existe = file_exists($ruta);
		

		if ($existe) {
			$path = public_path("uploads/" . $folder_name . "/" . $file->titulo);
			return Response::make(file_get_contents($path), 200, [
			"Content-Type" => "application/pdf",
			"Content-Disposition" => 'inline; filename="' . $file->titulo . '"',
		]);
		} else {
			return response()->json(['message' => 'El archivo no existe'], 200);
		}
		
		// return $path = storage_path($file->titulo);

		
	}
}