<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Repository\ProjectRepository;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    private ProjectRepository $repository;

    public function __construct()
    {
        $this->repository = new ProjectRepository();
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function get(int $projectId)
    {
        return $this->repository->get($projectId);
    }

    public function create(AuthenticatableContract $user, array $data)
    {
        return $this->repository->create($user, $data);
    }

    public function update(int $projectId, array $data)
    {
        return $this->repository->update($projectId, $data);
    }

    public function destroy(int $projectId)
    {
        DB::beginTransaction();

        Project::destroy($projectId)
//        Project::where('id',$projectId)->delete()
            ? DB::commit()
            : DB::rollBack();
    }
}
