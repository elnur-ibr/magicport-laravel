<?php

declare(strict_types=1);

namespace TaskController;

use App\Enums\TaskStatusEnum;
use App\Models\Project;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\TaskStoreRequestFactory;
use Tests\WithProjectsAndTasksTestCase;

class TaskControllerStoreTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function successNoStatus(): void
    {
        $project = $this->projects->get(2);

        $data = TaskStoreRequestFactory::new()
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('api.v1.project.task.store', ['project' => '1a']), $data);

        dump($response->status(), $response->json());

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', array_merge($data, ['status' => TaskStatusEnum::TODO->value]));
    }

    #[Test]
    public function successWithInProgressStatus(): void
    {
        $project = $this->projects->get(2);

        $data = TaskStoreRequestFactory::new()
            ->statusInProgress()
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('api.v1.project.task.store', ['project' => $project->id]), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', array_merge($data, ['status' => TaskStatusEnum::IN_PROGRESS->value]));
    }

    #[Test]
    public function tryingToAddTaskForNonUserProject(): void
    {
        $project = Project::factory()->withRandomUsers()->create();

        $data = TaskStoreRequestFactory::new()
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('api.v1.project.task.store', ['project' => $project->id]), $data);

        $response->assertStatus(404);

        $this->assertDatabaseMissing('tasks', $data);
    }
}
