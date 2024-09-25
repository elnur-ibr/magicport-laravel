<?php

declare(strict_types=1);

namespace ProjectController;

use App\Models\User;
use Tests\RequestFactories\ProjectStoreRequestFactory;
use Tests\TestCase;

class ProjectControllerStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $data = ProjectStoreRequestFactory::new()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson(route('api.v1.project.store'), $data);

        $this->assertDatabaseHas('projects', $data);

        $this->assertDatabaseHas('project_user', [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(200);
    }
}
