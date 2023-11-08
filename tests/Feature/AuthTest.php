<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_can_register(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201);
    }

    public function test_can_login(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'user@gmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }

    public function test_can_logout(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'user@gmail.com',
            'password' => 'password'
        ]);

        $token = $response->json()['data']['token'];

        $response = $this->withToken($token)->post('/api/logout');

        $response->assertStatus(204);
    }
}
