<?php

declare(strict_types=1);

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class TaskStoreRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            ''
            'name'        => $this->faker->text(240),
            'description' => $this->faker->text(500),
        ];
    }
}
