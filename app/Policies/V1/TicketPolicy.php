<?php

namespace App\Policies\V1;

use App\Models\Ticket;
use App\Models\User;
use PhpParser\Node\Expr\FuncCall;

class TicketPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Ticket $ticket){
        return $user->id === $ticket->user_id;
    }
}
