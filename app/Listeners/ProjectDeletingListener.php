<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ProjectDeleting;
use App\Models\ProjectUser;
use App\Models\Task;

class ProjectDeletingListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(ProjectDeleting $event): void
    {
        Task::where('project_id', $event->project->id)->delete();
        ProjectUser::where('project_id', $event->project->id)->delete();
    }
}
