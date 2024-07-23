<?php

namespace App\Observers;

use App\Events\TaskCompleted;
use App\Models\Task;
use Carbon\Carbon;

class TaskObserver
{

    public function updated(Task $task): void
    {
        if ($task->wasChanged('status') && $task->status == 1) {
            $task->completed_at = Carbon::now()->toDateString();
            $task->saveQuietly();

            TaskCompleted::dispatch($task);
        }
    }

}
