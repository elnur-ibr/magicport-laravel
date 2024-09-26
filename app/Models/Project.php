<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\ProjectDeleting;
use App\Models\Scopes\UserProjectScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectUser> $projectUser
 * @property-read int|null $project_user_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @method static Builder|Project user(\App\Models\User $user)
 * @mixin \Eloquent
 */
class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dispatchesEvents = [
        'deleting' => ProjectDeleting::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new UserProjectScope());
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function projectUser(): HasMany
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function scopeUser(Builder $query, User $user): Builder
    {
        return $query->whereRelation('projectUser', 'user_id', $user->id);
    }
}
