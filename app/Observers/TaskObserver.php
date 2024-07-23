<?php

namespace App\Observers;

use App\Events\TaskCompleted;
use App\Models\Task;
use Carbon\Carbon;

class TaskObserver
{
    public function updated(Task $task): void
    {
        if ($task->wasChanged('completed') && $task->completed) {
            $task->completed_at = Carbon::now();
            $task->save();

            TaskCompleted::dispatch($task);
        }
    }

}
