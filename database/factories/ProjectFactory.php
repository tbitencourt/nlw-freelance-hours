<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'title' => implode(' ', fake()->words(5)),
            'description' => fake()->text(), //fake()->randomHtml(),
            'ends_at' => fake()->dateTimeBetween('now', '+3 days'),
            'status' => fake()->randomElement(['open', 'closed']),
            'tech_stack' => fake()->randomElements([
                'nodejs',
                'react',
                'javascript',
                'vite',
                'nextjs',
            ], random_int(1, 5)),
            'created_by' => User::factory(),
        ];
    }
}
