<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(
        private MessageService $service
    ) {}

    public function index()
    {
        return response()->json([
            'data' => $this->service->getMessages()
        ], 200);
    }

    public function show($id)
    {
        $message = $this->service->getMessage($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json(['data' => $message], 200);
    }

    public function store(Request $request)
    {
        $message = $this->service->createMessage($request->all());

        return response()->json(['data' => $message], 201);
    }

    public function update(Request $request, $id)
    {
        $message = $this->service->updateMessage($id, $request->all());

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json(['data' => $message], 200);
    }

    public function destroy($id)
    {
        $deleted = $this->service->removeMessage($id);

        if (!$deleted) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json([], 204);
    }
}
