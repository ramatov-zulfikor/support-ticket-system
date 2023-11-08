<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Ticket;
use Tests\TestCase;

class TicketTest extends TestCase
{
    public function test_can_get_tickets_list(): void
    {
        $response = $this->get('/api/tickets');

        $response->assertStatus(200);
    }

    public function test_can_get_one_ticket(): void
    {
        $ticket = Ticket::query()->first();

        $response = $this->get('/api/tickets/' . $ticket->id);

        $response->assertStatus(200);
    }

    public function test_can_get_comments_of_ticket(): void
    {
        $ticket = Ticket::query()->first();

        $response = $this->get('/api/tickets/' . $ticket->id . '/comments');

        $response->assertStatus(200);
    }

    public function test_can_create_ticket(): void
    {
        $token = $this->getBearerToken();

        $response = $this->withToken($token)->post('/api/tickets', [
            'name' => 'Test ticket',
            'description' => 'Test description of ticket',
            'type' => 'issue'
        ]);

        $response->assertStatus(201);
    }

    public function test_can_update_ticket(): void
    {
        $token = $this->getBearerToken();
        $ticket = Ticket::query()->first();

        $response = $this->withToken($token)->put('/api/tickets/' . $ticket->id, [
            'name' => 'Updated name',
            'description' => 'Updated description',
            'type' => 'issue'
        ]);

        $response->assertStatus(200);
    }

    public function test_can_delete_ticket(): void
    {
        $token = $this->getBearerToken();
        $ticket = Ticket::query()->first();

        $response = $this->withToken($token)->delete('/api/tickets/' . $ticket->id);

        $response->assertStatus(204);
    }

    public function test_can_create_comment(): void
    {
        $token = $this->getBearerToken();
        $ticket = Ticket::query()->first();

        $response = $this->withToken($token)->post('/api/tickets/' . $ticket->id . '/comments', [
            'text' => 'This is a comment'
        ]);

        $response->assertStatus(201);
    }

    public function test_can_update_comment(): void
    {
        $token = $this->getBearerToken();
        $ticket = Ticket::query()->first();
        $comment = Comment::query()->first();

        $response = $this->withToken($token)->put('/api/tickets/' . $ticket->id . '/comments/' . $comment->id, [
            'text' => 'Updated comment'
        ]);

        $response->assertStatus(200);
    }

    public function test_can_delete_comment(): void
    {
        $token = $this->getBearerToken();
        $ticket = Ticket::query()->first();
        $comment = Comment::query()->first();

        $response = $this->withToken($token)->delete('/api/tickets/' . $ticket->id . '/comments/' . $comment->id);

        $response->assertStatus(204);
    }

    public function test_can_like_ticket(): void
    {
        $token = $this->getBearerToken();
        $ticket = Ticket::query()->first();

        $response = $this->withToken($token)->post('/api/tickets/' . $ticket->id . '/like');

        $response->assertStatus(200);
    }

    protected function getBearerToken(): string
    {
        $response = $this->post('/api/login', [
            'email' => 'user@gmail.com',
            'password' => 'password'
        ]);

        return $response->json()['data']['token'];
    }
}
