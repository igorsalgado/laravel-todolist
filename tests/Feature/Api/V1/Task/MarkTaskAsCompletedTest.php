<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\patchJson;

it('marks a task as completed', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');
    $task = Task::factory()->create([
        'user_id' => $user->id,
        'status' => false,
    ]);

    $response = patchJson("/api/v1/tasks/{$task->id}/complete");

    $response->assertOk();
    $response->assertJsonStructure(['data' => ['id', 'title', 'description', 'due_date', 'status', 'completed_at']]);
    $response->assertJsonPath('data.status', true);
    $response->assertJsonPath('data.completed_at', now()->toDateString());

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'status' => true,
        'completed_at' => now()->toDateString(),
    ]);
});
