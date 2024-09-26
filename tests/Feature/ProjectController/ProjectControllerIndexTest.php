<?php

declare(strict_types=1);

namespace Tests\Feature\ProjectController;

use PHPUnit\Framework\Attributes\Test;
use Tests\WithProjectsAndTasksTestCase;

class ProjectControllerIndexTest extends WithProjectsAndTasksTestCase
{
    #[Test]
    public function success(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('api.v1.project.index'));

        $response->assertStatus(200)->assertJson([
            'total' => 10,
        ]);
    }
}
