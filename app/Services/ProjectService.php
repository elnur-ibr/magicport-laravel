<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\ProjectRepository;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class ProjectService
{
    /**
     * @return void
     */
    public function create(AuthenticatableContract $user, array $data): Model
    {
        $repository = new ProjectRepository();

        return $repository->create($user, $data);
    }
}
