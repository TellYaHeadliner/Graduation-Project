<?php

namespace App\Http\Controllers\API\Chat;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'content' => 'required|string|max:1000',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['error' => 'Không xác định được người dùng.'], 401);
        }

        $partnerId = $request->partner_id;

        $conversation = Conversation::firstOrCreate(
            [
                'customer_id' => $user->id,
                'partner_id' => $partnerId,
            ],
            [
                'last_message' => '',
                'last_message_at' => now(),
            ]
        );

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'message' => $request->content,
            'sent_at' => now(),
        ]);

        $conversation->update([
            'last_message' => $request->content,
            'last_message_at' => now(),
            'unread_by_customer' => $user->id === $conversation->partner_id,
            'unread_by_partner' => $user->id === $conversation->customer_id,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'conversation_id' => $conversation->id,
            'data' => (new MessageSent($message))->broadcastWith(),
        ]);
    }

    public function getOrCreateConversation(Request $request, $partnerId)
    {
        $userId = $request->user_id;

        $conversation = Conversation::firstOrCreate(
            ['customer_id' => $userId, 'partner_id' => $partnerId],
            ['last_message' => '', 'last_message_at' => now()]
        );

        $messages = $conversation->messages()->with('user')->get()->map(function ($m) {
            return [
                'id' => $m->id,
                'text' => $m->message,
                'sender_id' => $m->sender_id,
                'sent_at' => $m->sent_at,
            ];
        });

        return response()->json([
            'id' => $conversation->id,
            'messages' => $messages,
        ]);
    }

    public function getMessages($id)
    {
        $conversation = Conversation::with(['messages.user'])->findOrFail($id);

        return response()->json([
            'messages' => $conversation->messages->map(fn($m) => [
                'id' => $m->id,
                'text' => $m->message,
                'sender_id' => $m->sender_id,
                'sent_at' => $m->sent_at,
            ])
        ]);
    }
}
