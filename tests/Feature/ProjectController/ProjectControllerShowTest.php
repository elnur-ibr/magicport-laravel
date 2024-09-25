<?php

declare(strict_types=1);

namespace ProjectController;

use Tests\WithProjectsAndTasksTestCase;

class ProjectControllerShowTest extends WithProjectsAndTasksTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $project = $this->projects->get(3);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('api.v1.project.show', ['project' => $project->id]));

        $response->assertStatus(200)->assertJsonFragment([
            'id'          => $project->id,
            'name'        => $project->name,
            'description' => $project->description,
        ]);
    }
}
