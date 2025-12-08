<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\MessageRepository;
use App\Models\Message;

class MessageService
{
    public function __construct(
        private MessageRepository $repository
    ) {}

    public function getMessages()
    {
        return $this->repository->findAll();
    }

    public function getMessage(int $id): ?Message
    {
        return $this->repository->find($id);
    }

    public function createMessage(array $data): Message
    {
        if (!isset($data['date'])) {
            $data['date'] = now();
        }

        return $this->repository->create($data);
    }

    public function updateMessage(int $id, array $data): ?Message
    {
        $message = $this->repository->find($id);

        if (!$message) {
            return null;
        }

        $message->fill($data);

        return $this->repository->save($message);
    }

    public function removeMessage(int $id): bool
    {
        $message = $this->repository->find($id);

        if (!$message) {
            return false;
        }

        $this->repository->delete($message);
        return true;
    }
}
