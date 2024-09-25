<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use App\Repository\ProjectRepository;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class ProjectService
{
    public function all()
    {
        return Project::paginate();
    }

    public function create(AuthenticatableContract $user, array $data)
    {
        $repository = new ProjectRepository();

        return $repository->create($user, $data);
    }
}
