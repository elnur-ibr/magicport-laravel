<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use App\Repository\TaskRepository;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Gate;

class TaskService
{
    public function __construct(private TaskRepository $repository)
    {

    }



    public function create(AuthenticatableContract $user, array $data)
    {
        Gate::forUser($user)->authorize('createTask', [Project::class, $data['project_id']]);

        return $this->repository->create($data);
    }


}
