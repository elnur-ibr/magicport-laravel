<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Project;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository
{
    public function create(AuthenticatableContract $user, array $data): Model
    {
        $project = Project::create($data);

        $project->users()->attach($user);
        $project->save();

        return $project;
    }
}
