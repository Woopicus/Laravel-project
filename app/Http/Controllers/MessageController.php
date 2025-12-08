<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function getMessages(): JsonResponse
    {
        $messages = $this->messageService->getMessages();

        return response()->json(['data' => $messages], Response::HTTP_OK);
    }

    public function getMessage(int $messageId): JsonResponse
    {
        $message = $this->messageService->getMessage($messageId);

        if ($message) {
            return response()->json(['data' => $message], Response::HTTP_OK);
        }

        return response()->json(['error' => 'Message not found'], Response::HTTP_NOT_FOUND);
    }

    public function createMessage(Request $request): JsonResponse
    {
        $message = $this->messageService->createMessage($request->all());

        return response()->json(['data' => $message], Response::HTTP_CREATED);
    }

    public function updateMessage(Request $request, int $messageId): JsonResponse
    {
        $message = $this->messageService->updateMessage($messageId, $request->all());

        if ($message) {
            return response()->json(['data' => $message], Response::HTTP_OK);
        }

        return response()->json(['error' => 'Message not found'], Response::HTTP_NOT_FOUND);
    }

    public function removeMessage(int $messageId): JsonResponse
    {
        $deleted = $this->messageService->removeMessage($messageId);

        if ($deleted) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json(['error' => 'Message not found'], Response::HTTP_NOT_FOUND);
    }
}
