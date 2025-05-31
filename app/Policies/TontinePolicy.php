<?php

namespace App\Policies;

use App\Models\Tontine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TontinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tontine $tontine): bool
    {
        return $user->tontines()->where('id', $tontine->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tontine $tontine): bool
    {
        return $user->hasRole($tontine->id, 'admin');;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tontine $tontine): bool
    {
        return $user->hasRole($tontine->id, 'admin');
    }

    public function viewNotes(User $user, Tontine $tontine)
    {
        // Autoriser les membres de la tontine à voir les notes
        return $user->tontines()->where('id', $tontine->id)->exists();
    }

    public function createNotes(User $user, Tontine $tontine)
    {
        // Autoriser les secrétaires à créer des notes
        return $user->hasRole($tontine->id, 'secretaire');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tontine $tontine): bool
    {
        return $user->hasRole($tontine->id, 'admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tontine $tontine): bool
    {
        return $user->hasRole($tontine->id, 'admin');
    }
}
