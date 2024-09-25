<?php

declare(strict_types=1);

namespace ProjectController;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\ProjectStoreRequestFactory;
use Tests\TestCase;

class ProjectControllerStoreTest extends TestCase
{
    #[Test]
    public function success(): void
    {
        $user = User::factory()->create();
        $data = ProjectStoreRequestFactory::new()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson(route('api.v1.project.store'), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('projects', $data);

        $this->assertDatabaseHas('project_user', [
            'user_id' => $user->id,
        ]);
    }
}
