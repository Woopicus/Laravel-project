<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Message;

class MessageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_list_of_messages(): void
    {
        Message::create([
            'message' => 'Hello world',
            'sender'  => 'Tester',
            'date'    => now(),
        ]);

        Message::create([
            'message' => 'Second message',
            'sender'  => 'Tester 2',
            'date'    => now(),
        ]);

        $response = $this->getJson('/api/messages');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_updates_a_message(): void
    {
        $message = Message::create([
            'message' => 'Old message',
            'sender'  => 'Old Sender',
            'date'    => now(),
        ]);

        $response = $this->putJson('/api/messages/' . $message->id, [
            'message' => 'Updated message',
            'sender'  => 'New Sender',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);

        $this->assertDatabaseHas('messages', [
            'id'      => $message->id,
            'message' => 'Updated message',
            'sender'  => 'New Sender',
        ]);
    }
}
