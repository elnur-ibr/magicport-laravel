<?php

declare(strict_types=1);

namespace ProjectController;

use App\Models\Project;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\ProjectStoreRequestFactory;
use Tests\WithProjectsAndTasksTestCase;

class ProjectControllerStoreTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function success(): void
    {
        $data = ProjectStoreRequestFactory::new()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('api.v1.project.store'), $data);

        $response->assertStatus(204);

        $this->assertDatabaseHas('projects', $data);

        $this->assertTrue(
            Project::where($data)->withoutGlobalScopes()->forUser($this->user)->exists(),
            'Project was not assigned to creator.'
        );
    }
}
