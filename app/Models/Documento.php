<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BicatoraEventoLogger;

class Documento extends Model
{
	use HasFactory, BicatoraEventoLogger;

	protected $hidden = [
		'id'
];

	protected $fillable = ["titulo", "uuid", "municipio_id"];

	public function getRouteKeyName()
	{
			return 'uuid';
	}

	public function municipio()
	{
		return $this->hasOne("App\Models\Enlace", "id", "municipio_id");
	}

	public static function hasUploaded($municipio)
	{
		$month = date('m');
		return where('municipio_id', '= ', $municipio)->whereRaw("DATE_FORMAT(documentos.created_at, '%m') = 12")->get();
	}
}
