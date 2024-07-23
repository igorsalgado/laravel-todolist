<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\putJson;

it('testa se um user possui acesso para update de uma task de outro user', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user1->id]);

    $this->actingAs($user2, 'sanctum');
    $updatedData = ['title' => 'Updated Task'];

    $response = putJson("/api/v1/tasks/{$task->id}", $updatedData);

    $response->assertForbidden(); // 403
    $this->assertDatabaseMissing('tasks', $updatedData + ['id' => $task->id]);
});
