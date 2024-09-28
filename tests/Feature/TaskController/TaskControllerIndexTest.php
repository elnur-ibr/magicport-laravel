<?php

declare(strict_types=1);

namespace TaskController;

use PHPUnit\Framework\Attributes\Test;
use Tests\WithProjectsAndTasksTestCase;

class TaskControllerIndexTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function successNoStatus(): void
    {
        $project = $this->projects->get(2);
        $project->loadMissing('tasks');

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('api.v1.project.task.index', ['project' => $project->id]));

        $response->assertStatus(200)->assertJsonStructure([
            'total',
            'data',
            'current_page',
        ])->assertJsonFragment([
            'current_page' => 1,
            'data'         => $project->tasks->toArray(),
        ]);
    }
}
