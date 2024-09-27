<?php

declare(strict_types=1);

namespace  Tests\Feature\ProjectController;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\WithProjectsAndTasksTestCase;

class ProjectControllerDeleteTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function success(): void
    {
        $project = $this->projects->get(2);

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson(route('api.v1.project.destroy', ['project' => $project->id]));

        $response->assertStatus(204);

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
        $this->assertDatabaseMissing('tasks', ['project_id' => $project->id]);
        $this->assertDatabaseMissing('project_user', ['project_id' => $project->id]);
    }

    #[Test]
    public function tryingToDeleteProjectThatDoesNotBelongToUser(): void
    {
        $project = Project::factory()->withRandomUsers()->withRandomNumberOfTask()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson(route('api.v1.project.destroy', ['project' => $project->id]));

        $response->assertStatus(404);

        $this->assertDatabaseHas('projects', ['id' => $project->id]);
        $this->assertDatabaseHas('tasks', ['project_id' => $project->id]);
        $this->assertDatabaseHas('project_user', ['project_id' => $project->id]);
    }

}
