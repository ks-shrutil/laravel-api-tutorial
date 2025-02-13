<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        Ticket::factory(100)
            ->recycle($users)
            ->create();
    }
}
