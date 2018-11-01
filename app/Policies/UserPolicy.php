<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function manage(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }
}
