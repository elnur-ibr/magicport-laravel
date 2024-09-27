<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function show(User $user, int|Project $project): Response
    {
        return ProjectUser::where([
            'project_id' => is_int($project) ? $project : $project->id,
            'user_id'    => $user->id,
        ])->exists()
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function update(User $user, int|Project $project): Response
    {
        return ProjectUser::where([
            'project_id' => is_int($project) ? $project : $project->id,
            'user_id'    => $user->id,
        ])->exists()
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function destroy(User $user, int|Project $project): Response
    {
        return ProjectUser::where([
            'project_id' => is_int($project) ? $project : $project->id,
            'user_id'    => $user->id,
        ])->exists()
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function createTask(User $user, int|Project $project): Response
    {
        return ProjectUser::where([
            'project_id' => is_int($project) ? $project : $project->id,
            'user_id'    => $user->id,
        ])->exists()
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
