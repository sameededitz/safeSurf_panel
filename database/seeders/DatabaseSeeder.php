<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Purchase;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->admin()->create();
        Plan::factory(15)->create();
        Purchase::factory(50)->create();

    }
}
