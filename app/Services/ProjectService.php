<?php

namespace App\Services;

use App\Repository\ProjectRepository;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class ProjectService
{
    /**
     * @param array $data
     *
     * @return void
     */
    public function create(AuthenticatableContract $user,array $data)
    {
        $repository = new ProjectRepository();

        return $repository->create($user, $data);
    }
}
