<?php

declare(strict_types=1);

namespace TaskController;

use PHPUnit\Framework\Attributes\Test;
use Tests\WithProjectsAndTasksTestCase;

class TaskControllerDestroyTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function success(): void
    {
        $project = $this->projects->get(2);
        $project->loadMissing('tasks');
        $task = $project->tasks->random();

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson(route('api.v1.project.task.destroy', ['project' => $project->id, 'task' => $task->id]));
        dump($response->status(),$response->content());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
