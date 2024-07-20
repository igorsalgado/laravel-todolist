<?php


namespace Tests\Feature\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use function Pest\Laravel\assertAuthenticated;

uses(RefreshDatabase::class);


it('Registrar user', function () {
    $userData = [
        'name' => 'Igor Salgado',
        'email' => 'igor@igor.com',
        'password' => 'password',
    ];

    $response = postJson('/api/v1/register', $userData);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'data' => [
            'id',
            'name',
            'email',
            'access_token',
            'token_type'
        ]
    ]);
    assertAuthenticated('sanctum');
});

it('Logar user', function () {
    $user = User::factory()->create();

    $loginData = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $response = postJson('/api/v1/login', $loginData);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data' => [
            'id',
            'name',
            'email',
            'access_token',
            'token_type'
        ]
    ]);
    $response->assertAuthenticated('sanctum');
});

it('Deslogar user', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = postJson('/api/v1/logout', [], ['Authorization' => 'Bearer ' . $token]);

    $response->assertStatus(200);
    $response->assertJson(['message' => 'Deslogado com sucesso!']);
    $this->assertGuest('sanctum');
});
