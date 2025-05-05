<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserFeedback;
use Database\Factories\TicketFactory;
use Database\Factories\TicketsFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\UserFeedbackFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->admin()->create();
        // Plan::factory(15)->create();
        // Purchase::factory(10)->create();
        // UserFeedback::factory(10)->create();
        Ticket::factory(2)->create();
    }
}
