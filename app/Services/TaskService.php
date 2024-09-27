<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use Illuminate\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\DB;

class TaskService
{
    private TaskRepository $repository;

    public function __construct()
    {
        $this->repository = new TaskRepository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function get(int $projectId)
    {
        return $this->repository->get($projectId);
    }

    public function create(array $data)
    {
        $project = Project::find($data['project_id']);

        Gate::authorize('haveAccess', $project);

        return $this->repository->create($data);
    }

    public function update(int $projectId, array $data)
    {
        return $this->repository->update($projectId, $data);
    }

    public function destroy(int $projectId): void
    {
        DB::beginTransaction();

        Project::destroy($projectId)
//        Project::where('id',$projectId)->delete()
            ? DB::commit()
            : DB::rollBack();
    }
}
