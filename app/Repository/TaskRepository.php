<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\TaskStatusEnum;
use App\Models\Task;

class TaskRepository
{
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
