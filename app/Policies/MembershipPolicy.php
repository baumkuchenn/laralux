<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class MembershipPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function check(User $user)
    {
        return ($user->role == 'owner')
        ? Response::allow()
        : Response::deny('Hanya untuk owner');
    }
}
