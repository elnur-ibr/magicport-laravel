<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository
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

    public function create(array $data): Project
    {
        $task = Task::create($data);

        return Task::create($data);
    }

    public function update(int $projectId, array $data): Project
    {
        $project = $this->get($projectId);
        $project->update($data);

        return $project;
    }
}
