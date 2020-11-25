<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
	use HasFactory;

	protected $fillable = ["titulo", "municipio_id"];

	public function municipio()
	{
		return $this->hasOne("App\Models\Enlace", "id", "municipio_id");
	}
}
