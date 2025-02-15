<?php

namespace App\Policies\V1;

use PhpParser\Node\Expr\FuncCall;
use App\Permissions\V1\Abilities;
use App\Models\Ticket;
use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, User $model)
    {
        return $user->tokenCan(Abilities::DeleteUser);
    }

    public function replace(User $user)
    {
        return $user->tokenCan(Abilities::ReplaceUser);
    }

    public function store(User $user, User $model)
    {
        return ($user->tokenCan(Abilities::CreateUser));
    }


    public function update(User $user, User $model)
    {
        return ($user->tokenCan(Abilities::UpdateUser));
    }
}
