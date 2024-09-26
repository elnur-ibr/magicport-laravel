<?php

declare(strict_types=1);

namespace ProjectController;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\ProjectStoreRequestFactory;
use Tests\WithProjectsAndTasksTestCase;

class ProjectControllerDeleteTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function success(): void
    {
        $project = $this->projects->get(2);

        DB::enableQueryLog();

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson(route('api.v1.project.destroy', ['project' => $project->id]));

        dump($response->status(), $response->content(), DB::getQueryLog());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }

    #[Test]
    public function tryingToDeleteProjectThatDoesNotBelongToUser(): void
    {
        $project = Project::factory()->withRandomUsers()->create();

        DB::enableQueryLog();

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson(route('api.v1.project.destroy', ['project' => $project->id]));

        dump($response->status(), $response->content(), DB::getQueryLog());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }
}
