<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->text(240),
            'description' => $this->faker->text(500),
        ];
    }

    public function withRandomUsers(): static
    {
        return $this->afterCreating(function (Project $project): void {
            $project->users()->attach(User::factory()->create());
        });
    }
}
