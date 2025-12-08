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
            'type'        => 'info',
            'subject'     => 'Greeting',
            'content'     => 'Hello world',
            'sender_name' => 'Tester',
            'date'        => now(),
        ]);

        Message::create([
            'type'        => 'info',
            'subject'     => 'Second Subject',
            'content'     => 'Second message',
            'sender_name' => 'Tester 2',
            'date'        => now(),
        ]);

        $response = $this->getJson('/api/messages');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_updates_a_message(): void
    {
        $message = Message::create([
            'type'        => 'info',
            'subject'     => 'Old Subject',
            'content'     => 'Old message',
            'sender_name' => 'Old Sender',
            'date'        => now(),
        ]);

        $response = $this->putJson('/api/messages/' . $message->id, [
            'subject'     => 'Updated Subject',
            'content'     => 'Updated message',
            'sender_name' => 'New Sender',
            'type'        => 'info',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);

        $this->assertDatabaseHas('messages', [
            'id'          => $message->id,
            'subject'     => 'Updated Subject',
            'content'     => 'Updated message',
            'sender_name' => 'New Sender',
            'type'        => 'info',
        ]);
    }
}
