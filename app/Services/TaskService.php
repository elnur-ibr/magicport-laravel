<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use App\Repository\TaskRepository;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Gate;

class TaskService
{
    public function __construct(private TaskRepository $repository) {}

    public function create(AuthenticatableContract $user, int $projectId, array $data)
    {
        Gate::forUser($user)->authorize('createTask', [Project::class, $projectId]);

        return $this->repository->create($projectId, $data);
    }
}
