<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Task\StoreTaskRequest;
use App\Http\Requests\Api\V1\Task\UpdateTaskRequest;
use App\Http\Resources\Api\V1\Task\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::query()->where('user_id', Auth::id())->get();
        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $task = Task::create($validated);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Não autorizado');
        }
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest  $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Não autorizado');
        }
        $task->update($request->validated());
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Não autorizado');
        }
        $task->delete();

        return response(null, 204);
    }

    public function complete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $task->update(['completed' => true]);
        return new TaskResource($task);
    }
}
