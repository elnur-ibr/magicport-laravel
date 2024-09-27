<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser query()
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectUser whereUserId($value)
 * @mixin \Eloquent
 */
class ProjectUser extends Model
{
    use HasFactory;

    protected $table = 'project_user';

    protected $guarded = ['id'];
}
