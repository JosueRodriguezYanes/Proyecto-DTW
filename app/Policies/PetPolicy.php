<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;

class PetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        // Todos los usuarios autenticados pueden ver el listado
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pet $pet)
    {
        // Admin puede ver todo, user solo sus mascotas
        return ($user->role === 'admin') || ($user->id === $pet->user_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        // Solo admin y user pueden crear mascotas
        return in_array($user->role, ['admin', 'user']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pet $pet)
    {
        // Admin puede editar todo, user solo sus mascotas
        return ($user->role === 'admin') || ($user->id === $pet->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pet $pet)
    {
        // Admin puede eliminar todo, user solo sus mascotas
        return ($user->role === 'admin') || ($user->id === $pet->user_id);
    }
}
