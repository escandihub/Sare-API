<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
	use HasFactory;

	protected $fillable = ["titulo", "usuario_id"];

	public function usuario()
	{
		return $this->hasOne("App\Models\Usuario", "usuario_id", "id");
	}
}
