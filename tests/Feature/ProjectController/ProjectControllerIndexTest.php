<?php

declare(strict_types=1);

namespace Tests\Feature\ProjectController;

use Tests\WithProjectsAndTasksTestCase;

class ProjectControllerIndexTest extends WithProjectsAndTasksTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('api.v1.project.index'));

        $response->assertStatus(200)->assertJson([
            'total' => 10,
        ]);
    }
}
