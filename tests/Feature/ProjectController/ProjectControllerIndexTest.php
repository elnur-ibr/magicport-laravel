<?php

declare(strict_types=1);

namespace Tests\Feature\ProjectController;

use App\Models\User;
use Tests\TestCase;

class ProjectControllerIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user     = User::factory()->create();
        $response = $this->actingAs($user, 'sanctum')
            ->getJson(route('api.v1.project.index'));

        dump($response->status(), $response->json());

        $response->assertStatus(200);
    }
}
