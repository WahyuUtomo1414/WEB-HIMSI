<?php

namespace App\Http\Controllers;

use App\Services\AiChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AiChatController extends Controller
{
    public function chat(Request $request, AiChatService $service): JsonResponse
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:1000'],
            'session_id' => ['required', 'uuid'],
            'history' => ['nullable', 'array'],
            'history.*.role' => ['required_with:history', 'in:user,assistant'],
            'history.*.content' => ['required_with:history', 'string'],
        ]);

        try {
            $result = $service->chat(
                question: $validated['question'],
                sessionId: $validated['session_id'],
                history: $validated['history'] ?? [],
                ip: $request->ip(),
            );

            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json([
                'answer' => 'Maaf, terjadi kesalahan. Silakan coba lagi.',
                'blocked' => false,
            ], 500);
        }
    }
}
