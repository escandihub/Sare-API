<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_permiso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->foreignId('permiso_id')->references('id')->on('permisos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_permiso');
    }
}
