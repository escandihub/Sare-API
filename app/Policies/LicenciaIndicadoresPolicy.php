<?php

namespace App\Policies;

use App\Models\Licencia;
use App\Models\usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class LicenciaIndicadoresPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\usuario  $usuario
     * @return mixed
     */
    public function viewAny(usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\usuario  $usuario
     * @param  \App\Models\Licencia  $licencia
     * @return mixed
     */
    public function view(usuario $usuario, Licencia $licencia)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\usuario  $usuario
     * @return mixed
     */
    public function create(usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\usuario  $usuario
     * @param  \App\Models\Licencia  $licencia
     * @return mixed
     */
    public function update(usuario $usuario, Licencia $licencia)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\usuario  $usuario
     * @param  \App\Models\Licencia  $licencia
     * @return mixed
     */
    public function delete(usuario $usuario, Licencia $licencia)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\usuario  $usuario
     * @param  \App\Models\Licencia  $licencia
     * @return mixed
     */
    public function restore(usuario $usuario, Licencia $licencia)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\usuario  $usuario
     * @param  \App\Models\Licencia  $licencia
     * @return mixed
     */
    public function forceDelete(usuario $usuario, Licencia $licencia)
    {
        //
    }
}
