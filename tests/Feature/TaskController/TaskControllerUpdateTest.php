<?php

declare(strict_types=1);

namespace TaskController;

use App\Enums\TaskStatusEnum;
use App\Models\Project;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\TaskStoreRequestFactory;
use Tests\WithProjectsAndTasksTestCase;

class TaskControllerUpdateTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function successNoStatus(): void
    {
        $project = $this->projects->get(2);
        $project->loadMissing('tasks');
        $task = $project->tasks->get(2);

        $data = TaskStoreRequestFactory::new()
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson(route('api.v1.project.task.update', ['project' => $project->id, 'task' => $task->id]), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', array_merge($data, [
            'task_id' => $task->id,
            'status'  => TaskStatusEnum::TODO->value
        ]));
    }
}
