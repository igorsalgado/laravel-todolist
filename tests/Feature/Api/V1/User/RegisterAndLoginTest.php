<?php

namespace Tests\Feature\Api\V1\User;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('Registrar e logar no sistema', function () {
    $userData = [
        'name' => 'Igor',
        'email' => 'igor@igor.com',
        'password' => 'password',
        'password_confirmation' => 'password'
    ];

    $response = post('/api/v1/register', $userData);

    $response
        ->assertStatus(201)
        ->assertJsonStructure([
            'data' => ['id', 'name', 'email'],
            'access_token',
            'token_type'
        ]);
    $token = $response->json('access_token');

    //tenta acessar rota protegida
    $protectedRoute = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->getJson('/api/v1/tasks');

    $protectedRoute->assertStatus(200);
});
