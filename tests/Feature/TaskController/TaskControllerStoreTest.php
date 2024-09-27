<?php

declare(strict_types=1);

namespace TaskController;

use App\Models\Project;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\ProjectStoreRequestFactory;
use Tests\WithProjectsAndTasksTestCase;

class TaskControllerStoreTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function success(): void
    {
        $data = ProjectStoreRequestFactory::new()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('api.v1.project.store'), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('projects', $data);

        $this->assertTrue(
            Project::where($data)->withoutGlobalScopes()->user($this->user)->exists(),
            'Project was not assigned to creator.'
        );
    }
}
