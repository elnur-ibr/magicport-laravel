<?php

declare(strict_types=1);

namespace ProjectController;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\ProjectStoreRequestFactory;
use Tests\WithProjectsAndTasksTestCase;

class ProjectControllerUpdateTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function success(): void
    {
        $data = ProjectStoreRequestFactory::new()->create();
        $project = $this->projects->get(2);

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson(route('api.v1.project.update', ['project' => $project->id]), $data);

        $response->assertStatus(204);

        $this->assertDatabaseHas('projects', [
            'id'          => $project->id,
            'name'        => $data['name'],
            'description' => $data['description'],
        ]);
    }

    #[Test]
    public function tryingToUpdateProjectThatDoesNotBelongToUser(): void
    {
        $data = ProjectStoreRequestFactory::new()->create();
        $project = Project::factory()->withRandomUsers()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson(route('api.v1.project.update', ['project' => $project->id]), $data);

        $response->assertStatus(404);

        // To make sure nothing changed
        $this->assertDatabaseHas('projects', [
            'id'          => $project->id,
            'name'        => $project->name,
            'description' => $project->description,
        ]);
    }
}
