<?php

declare(strict_types=1);

namespace TaskController;

use App\Enums\TaskStatusEnum;
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
        $task = $project->tasks->random();

        $data = TaskStoreRequestFactory::new()
            ->statusInProgress()
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson(route('api.v1.project.task.update', ['project' => $project->id, 'task' => $task->id]), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', array_merge($data, [
            'id' => $task->id,
            'status'  => TaskStatusEnum::IN_PROGRESS->value,
        ]));
    }
}
