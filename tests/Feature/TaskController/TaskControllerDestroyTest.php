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
            ->getJson(route('api.v1.project.task.destroy', ['project' => $project->id, 'task' => $task->id]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id'          => $task->id,
                'project_id'  => $task->project_id,
                'name'        => $task->name,
                'description' => $task->description,
                'status'      => $task->status,
            ]);
    }
}
