<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BicatoraEventoLogger;

class CierreCaptura extends Model
{
    use HasFactory, BicatoraEventoLogger;

    protected $fillable = ["fecha_inicial", "fecha_final"];
}
