<?php

declare(strict_types=1);

namespace Tests\RequestFactories;

use App\Enums\TaskStatusEnum;
use App\Models\Project;
use Worksome\RequestFactories\RequestFactory;

class TaskStoreRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->text(200),
            'description' => $this->faker->text(500),
        ];
    }

    public function statusInProgress(): static
    {
        return $this->status(TaskStatusEnum::IN_PROGRESS->value);
    }

    public function status($status): static
    {
        return $this->state(['status' => $status]);
    }
}
