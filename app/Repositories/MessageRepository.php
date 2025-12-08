<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function findAll()
    {
        return Message::all();
    }

    public function find(int $id): ?Message
    {
        return Message::find($id);
    }

    public function save(Message $message): Message
    {
        $message->save();
        return $message;
    }

    public function create(array $data): Message
    {
        return Message::create($data);
    }

    public function delete(Message $message): void
    {
        $message->delete();
    }
}
