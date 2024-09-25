<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserProjectScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder|Project  $builder
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereRelation('projectUser', 'user_id', Auth::id());
    }
}
