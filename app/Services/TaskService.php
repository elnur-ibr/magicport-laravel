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

    public function all(AuthenticatableContract $user, int $projectId)
    {
        Gate::forUser($user)->authorize('allTask', [Project::class, $projectId]);

        return $this->repository->all($projectId);
    }

    public function create(AuthenticatableContract $user, int $projectId, array $data)
    {
        Gate::forUser($user)->authorize('createTask', [Project::class, $projectId]);

        return $this->repository->create($projectId, $data);
    }

    public function update(AuthenticatableContract $user, int $projectId, int $taskId, array $data)
    {
        Gate::forUser($user)->authorize('updateTask', [Project::class, $projectId]);

        return $this->repository->update($taskId, $data);
    }
}
