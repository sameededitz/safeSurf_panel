<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserFeedback;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->admin()->create();
        // User::factory()->user()->create();
        
        // $this->call([
        //     PlanSeeder::class,
        // ]);
        Purchase::factory(10)->create();
    }
}
