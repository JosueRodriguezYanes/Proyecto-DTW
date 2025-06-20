<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\Usuario;

class PetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario  $user)
    {
        // Todos los usuarios autenticados pueden ver el listado
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $user, Pet $pet)
    {
        // Admin puede ver todo, user solo sus mascotas
        return true; // Permitir a todos los usuarios autenticados ver
}

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $user)
    {
        return true; // ← Esto permite a cualquier usuario crear mascotas
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $user, Pet $pet)
    {
         return true; 
}

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $user, Pet $pet)
    {
        // Admin puede eliminar todo, user solo sus mascotas
         return true; // Permitir a todos los usuarios autenticados ver
}
}
