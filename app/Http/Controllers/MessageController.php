<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(private MessageService $messageService)
    {
    }

    public function getMessages()
    {
        $messages = $this->messageService->getMessages();

        return response()->json(['data' => $messages], 200);
    }

    public function getMessage(int $messageId)
    {
        $message = $this->messageService->getMessage($messageId);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json(['data' => $message], 200);
    }

    public function createMessage(Request $request)
    {
        $message = $this->messageService->createMessage($request->all());

        return response()->json(['data' => $message], 201);
    }

    public function updateMessage(Request $request, int $messageId)
    {
        $message = $this->messageService->updateMessage($messageId, $request->all());

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json(['data' => $message], 200);
    }

    public function removeMessage(int $messageId)
    {
        $deleted = $this->messageService->removeMessage($messageId);

        if (!$deleted) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json([], 204);
    }
}
