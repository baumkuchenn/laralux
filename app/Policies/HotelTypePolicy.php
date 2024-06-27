<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class HotelTypePolicy
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
        return ($user->role != 'customer')
        ? Response::allow()
        : Response::deny('Hanya untuk pegawai');
    }
}
