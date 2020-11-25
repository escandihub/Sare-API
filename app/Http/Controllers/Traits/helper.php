<?php
namespace App\Http\Controllers\Traits;

trait helper
{
	public function replaceSpecialCharacters($municipio)
	{
		$cadena = str_replace(
			["á", "é", "í", "ó", "ú"],
			["a", "e", "i", "o", "u"],
			$municipio
		);
		return $cadena;
	}

	public function convertStringToUnderscore($municipio)
	{
		$sin_caracteres = $this->replaceSpecialCharacters($municipio);
		$to_lowe_case = strtolower($sin_caracteres);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $to_lowe_case);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "_", $string);

		return $string;
	}
}
