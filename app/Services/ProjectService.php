<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use App\Repository\ProjectRepository;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProjectService
{
    private ProjectRepository $repository;

    public function __construct()
    {
        $this->repository = new ProjectRepository();
    }

    public function all(AuthenticatableContract $user)
    {
        return $this->repository->all($user);
    }

    public function show(int $projectId, AuthenticatableContract $user): ?Project
    {
        Gate::forUser($user)->authorize('show', [Project::class, $projectId]);

        return $this->repository->get($projectId);
    }

    public function create(AuthenticatableContract $user, array $data)
    {
        return $this->repository->create($user, $data);
    }

    public function update(AuthenticatableContract $user, int $projectId, array $data)
    {
        Gate::forUser($user)->authorize('update', [Project::class, $projectId]);

        return $this->repository->update($projectId, $data);
    }

    public function destroy(AuthenticatableContract $user, int $projectId): void
    {
        Gate::forUser($user)->authorize('destroy', [Project::class, $projectId]);

        DB::beginTransaction();

        Project::destroy($projectId)
            ? DB::commit()
            : DB::rollBack();
    }
}
