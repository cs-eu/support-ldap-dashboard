<?php

namespace App\Policies;

use App\Models\BeamerAccess;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BeamerAccessPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false; // TODO: restrict to newman.net
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BeamerAccess $beamerAccess): bool
    {
        return false; // TODO: restrict to newman.net
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
    public function update(User $user, BeamerAccess $beamerAccess): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BeamerAccess $beamerAccess): bool
    {
        return false; // TODO: restrict to newman.net
    }
}
