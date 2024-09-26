<?php

declare(strict_types=1);

namespace ProjectController;

use App\Models\Project;
use PHPUnit\Framework\Attributes\Test;
use Tests\WithProjectsAndTasksTestCase;

class ProjectControllerShowTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function success(): void
    {
        $project = $this->projects->get(3);
        $project->loadMissing('tasks');

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('api.v1.project.show', ['project' => $project->id]));

        $response->assertStatus(200)->assertJsonFragment([
            'id'          => $project->id,
            'name'        => $project->name,
            'description' => $project->description,
            'tasks_count' => $project->tasks->count(),
        ]);
    }

    #[Test]
    public function tryingToAccessProjectThatDoesNotBelongToUser(): void
    {
        $project = Project::factory()->withRandomUsers()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('api.v1.project.show', ['project' => $project->id]));

        $response->assertStatus(404);
    }
}
