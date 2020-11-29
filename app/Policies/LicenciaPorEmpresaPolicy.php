<?php

namespace App\Policies;

use App\Models\LicenciaEmpresa;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;

class LicenciaPorEmpresaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function viewAny(Usuario $usuario)
    {
        return $usuario->id > 0
        ? Response::allow()
        : Response::deny('Privilegios insuficuentes');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\usuario  $usuario
     * @param  \App\Models\LicenciaEmpresa.php  $licenciaEmpresa.php
     * @return mixed
     */
    public function view(Usuario $usuario, LicenciaEmpresa $licenciaEmpresa)
    {
        return $usuario->id > 0
        ? Response::allow()
        : Response::deny('Privilegios insuficuentes');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function create(Usuario $usuario)
    {
        return $usuario->id > 1
        ? Response::allow()
        : Response::deny('No puede crear Licencias' . $usuario->nombre);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\LicenciaEmpresa.php  $licenciaEmpresa
     * @return mixed
     */
    public function update(Usuario $usuario, LicenciaEmpresa $licenciaEmpresa)
    {
        return $usuario->enlace->id === $licenciaEmpresa->IdEnlaceMunicipal && $licenciaEmpresa->MesConcluido == 0
        ? Response::allow()
        : Response::deny('Privilegios insuficientes para esta operación.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\usuario  $usuario
     * @param  \App\Models\LicenciaEmpresa.php  $licenciaEmpresa.php
     * @return mixed
     */
    public function delete(Usuario $usuario, LicenciaEmpresa $licenciaEmpresa)
    {
        return $usuario->enlace->id === $licenciaEmpresa->IdEnlaceMunicipal
        ? Response::allow()
        : Response::deny('Privilegios insuficientes.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\usuario  $usuario
     * @param  \App\Models\LicenciaEmpresa.php  $licenciaEmpresa.php
     * @return mixed
     */
    public function restore(Usuario $usuario, LicenciaEmpresa $licenciaEmpresa)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\usuario  $usuario
     * @param  \App\Models\LicenciaEmpresa.php  $licenciaEmpresa.php
     * @return mixed
     */
    public function forceDelete(Usuario $usuario, LicenciaEmpresa $licenciaEmpresa)
    {
        //
    }
}
