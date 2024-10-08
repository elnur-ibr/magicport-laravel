<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    /**
     * Checking if project assigned to user and task related to project
     */
    protected function isProjectAssignedAndTaskRelated(User $user, int|Project $project, int|Task $task): bool
    {
        return ProjectUser::where([
            'project_id' => is_int($project) ? $project : $project->id,
            'user_id'    => $user->id,
        ])->whereRelation('tasks', 'tasks.id', is_int($task) ? $task : $task->id)->exists();
    }

    public function update(User $user, int|Project $project, int|Task $task): Response
    {
        return $this->isProjectAssignedAndTaskRelated($user, $project, $task)
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function show(User $user, int|Project $project, int|Task $task): Response
    {
        return $this->isProjectAssignedAndTaskRelated($user, $project, $task)
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function destroy(User $user, int|Project $project, int|Task $task): Response
    {
        return $this->isProjectAssignedAndTaskRelated($user, $project, $task)
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
