<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id'  => Project::factory(),
            'name'        => $this->faker->text(240),
            'description' => $this->faker->text(500),
            'status'      => TaskStatusEnum::TODO,
        ];
    }
}
