<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Project;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectRepository
{
    public function all(): LengthAwarePaginator
    {
        return Project::withCount('tasks')
            ->paginate();
    }

    public function get(int $projectId): Project
    {
        return Project::withCount('tasks')
            ->where('id', $projectId)
            ->firstOrFail();
    }

    public function create(AuthenticatableContract $user, array $data): Project
    {
        $project = Project::create($data);

        $project->users()->attach($user)->save();

        return $project;
    }

    public function update(int $projectId, array $data): Project {
        $project = $this->get($projectId);
        $project->update($data);

        return $project;
    }
}
