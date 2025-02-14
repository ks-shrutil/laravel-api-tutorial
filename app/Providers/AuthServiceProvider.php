<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Models\User;
use App\Policies\V1\TicketPolicy;
use App\Policies\V1\UserPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }


    protected $policies =[
        Ticket::class => TicketPolicy::class,
        User::class => UserPolicy::class
    ];
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
