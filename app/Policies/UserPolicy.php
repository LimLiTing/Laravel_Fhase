<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // app/Policies/UserPolicy.php
    
    public function viewAny(User $user)
    {
        // Check if the user has the "viewAny" permission
        return $user->hasPermission('viewAny');
    }

    public function view(User $user, User $model)
    {
        // Check if the user has the "view" permission
        return $user->hasPermission('view');
    }
}
