<?php

namespace Tests\Feature\Api\V1\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('Deslogar usuario', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = postJson('/api/v1/logout', [], ['Authorization' => 'Bearer ' . $token]);

    $response
        ->assertStatus(200)
        ->assertJson(['message' => 'Usuário deslogado com sucesso!']);
});
