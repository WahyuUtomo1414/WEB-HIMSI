<?php

namespace App\Http\Controllers;

use App\Models\AiConfig;
use App\Services\AiChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AiChatController extends Controller
{
    public function index(): View
    {
        $config = AiConfig::where('active', true)->first();
        if ($config && ! $config->is_enabled) {
            abort(404);
        }

        // Mark modal as dismissed so visiting AI directly prevents home modal from showing
        cookie()->queue(cookie('himsi_ai_modal_dismissed', 'true', 60 * 24 * 365, '/'));
        session(['himsi_ai_modal_dismissed' => true]);

        $greeting = $config?->greeting_message ?: 'Halo! Ada yang bisa saya bantu seputar HIMSI UBSI?';

        return view('pages.ai.index', [
            'greeting' => $greeting,
        ]);
    }

    public function dismissModal(): JsonResponse
    {
        cookie()->queue(cookie('himsi_ai_modal_dismissed', 'true', 60 * 24 * 365, '/'));
        session(['himsi_ai_modal_dismissed' => true]);

        return response()->json(['status' => 'ok']);
    }

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
