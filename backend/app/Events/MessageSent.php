<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageSent implements ShouldBroadcastNow
{
    use SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message->load('user');
    }

    public function broadcastOn()
    {
        $conversation = $this->message->conversation;

        return [
            new PrivateChannel('conversation.' . $this->message->conversation_id),
            new PrivateChannel('App.Models.User.' . $conversation->partner_id),
        ];
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'sender_id' => $this->message->sender_id,
            'content' => $this->message->message,
            'conversation_id' => $this->message->conversation_id,
            'sent_at' => $this->message->sent_at,
        ];
    }
}
