<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\TaskStatusEnum;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository
{
    public function all(int $projectId): LengthAwarePaginator
    {
        return Task::where('project_id', $projectId)->paginate();
    }

    public function create(int $projectId, array $data): Task
    {
        return Task::create(array_merge(
            [
                'status'     => TaskStatusEnum::TODO,
                'project_id' => $projectId,
            ],
            $data
        ));
    }
}
