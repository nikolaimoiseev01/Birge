<?php

namespace App\Http\Controllers;

use App\Models\TelegramPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TelegramWebhookController
{
    public function __invoke(Request $request)
    {
        $post = $request->input('channel_post')
            ?? $request->input('message');

        if (!$post) {
            return response()->json(['not_telegram' => true]);
        }

        $text = $post['text']
            ?? $post['caption']
            ?? null;
        $title = $text
            ? Str::before(str_replace("\r", '', $text), "\n")
            : null;

        TelegramPost::updateOrCreate(
            [
                'telegram_message_id' => $post['message_id'],
            ],
            [
                'chat_id' => $post['chat']['id'],
                'text' => $title,
                'published_at' => isset($post['date'])
                    ? now()->setTimestamp($post['date'])
                    : now(),
            ]
        );

        Log::info('Telegram post received', $post);

        return response()->json(['ok' => true]);
    }
}
