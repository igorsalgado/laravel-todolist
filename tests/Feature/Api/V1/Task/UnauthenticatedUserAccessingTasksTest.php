<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\getJson;

it('Testa se um user nao autenticado tem acesso as tasks', function () {
    $user = User::factory()->create();
    //$this->actingAs($user, 'sanctum'); //retorna 200
    Task::factory(3)->create(['user_id' => $user->id]);

    $response = getJson('/api/v1/tasks');

    $response->assertUnauthorized(); //401
});
