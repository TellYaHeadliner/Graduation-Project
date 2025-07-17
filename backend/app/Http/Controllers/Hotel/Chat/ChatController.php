<?php

namespace App\Http\Controllers\Hotel\Chat;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{


    public function index()
    {
        $user = auth()->user();

        $conversations = Conversation::where('partner_id', $user->id)
            ->with(['customer'])
            ->orderByDesc('last_message_at')
            ->get();

        return view('hotel.chat.index')->with(['conversations' => $conversations]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'content' => 'required|string|max:1000',
        ]);

        $user = auth()->user();
        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!in_array($user->id, [$conversation->customer_id, $conversation->partner_id])) {
            return response()->json(['error' => 'Bạn không có quyền gửi tin nhắn.'], 403);
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => $user->id,
            'message'         => $request->content,
            'sent_at'         => now(),
        ]);

        $conversation->update([
            'last_message'       => $request->content,
            'last_message_at'    => now(),
            'unread_by_customer' => $user->id === $conversation->partner_id,
            'unread_by_partner'  => $user->id === $conversation->customer_id,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'data'    => (new MessageSent($message))->broadcastWith(),
        ]);
    }

    public function fetch($hotel_id, $id)
    {
        $user = auth()->user();
        $conversation = Conversation::with('messages')->find($id);

        if (!$conversation) {
            return response()->json(['error' => 'Cuộc trò chuyện không tồn tại.'], 404);
        }

        if (!in_array($user->id, [$conversation->customer_id, $conversation->partner_id])) {
            return response()->json(['error' => 'Không có quyền truy cập cuộc trò chuyện này.'], 403);
        }

        return response()->json([
            'id'       => $conversation->id,
            'messages' => $conversation->messages()->latest()->take(50)->get()->reverse()->values(),
        ]);
    }

    public function messageList($hotel_id)
    {
        $user = auth()->user();

        $conversations = Conversation::where('partner_id', $user->id)
            ->with('customer')
            ->orderByDesc('last_message_at')
            ->get();

        return view('hotel.chat.partials.conversation_list', compact('conversations'))->render();   
    }
}
