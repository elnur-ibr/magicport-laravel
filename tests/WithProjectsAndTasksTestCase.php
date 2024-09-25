<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class WithProjectsAndTasksTestCase extends TestCase
{
    protected User $user;

    /**
     * @var Project[]|Collection
     */
    protected Collection $projects;

    protected function setUp(): void
    {
        parent::setUp();

        // Some random projects
        Project::factory(5)->withRandomUsers()->withRandomNumberOfTask()->create();

        // Creating test user and test data
        $this->user     = User::factory()->create();
        $this->projects = Project::factory(10)->withRandomNumberOfTask()->create();
        $this->user->projects()->attach($this->projects);
    }
}
