<?php

declare(strict_types=1);

namespace TaskController;

use PHPUnit\Framework\Attributes\Test;
use Tests\WithProjectsAndTasksTestCase;

class TaskControllerShowTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function success(): void
    {
        $project = $this->projects->get(2);
        $project->loadMissing('tasks');
        $task = $project->tasks->random();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('api.v1.project.task.show', ['project' => $project->id, 'task' => $task->id]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id'          => $task->id,
                'project_id'  => $task->project_id,
                'name'        => $task->name,
                'description' => $task->description,
                'status'      => $task->status,
            ]);
    }

    #[Test]
    public function tryingToAccessDifferentProjectTask(): void
    {
        $project = $this->projects->get(2);
        $project->loadMissing('tasks');
        $task = $this->projects->get(1)->tasks->random();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('api.v1.project.task.show', ['project' => $project->id, 'task' => $task->id]));

        $response->assertStatus(404);
    }
}
