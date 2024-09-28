<?php

declare(strict_types=1);

namespace TaskController;

use App\Enums\TaskStatusEnum;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\ProjectStoreRequestFactory;
use Tests\RequestFactories\TaskStoreRequestFactory;
use Tests\WithProjectsAndTasksTestCase;

class TaskControllerIndexTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function successNoStatus(): void
    {
        $project = $this->projects->get(2);

        $data = TaskStoreRequestFactory::new()
            ->projectId($project->id)
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('api.v1.task.store'), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', array_merge($data, ['status' => TaskStatusEnum::TODO->value]));
    }
}
