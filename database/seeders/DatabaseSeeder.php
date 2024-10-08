<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(200)->create();
         User::query()->inRandomOrder()->limit(10)->get()
            ->each(fn ($user)  => Project::factory()->create(['created_by' => $user->id]));
    }
}
