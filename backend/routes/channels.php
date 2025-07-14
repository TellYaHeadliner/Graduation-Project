<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('conversation.{id}', function ($user, $id) {
    $conversation = Conversation::find($id);

    Log::info('Attempting to join channel', [
        'user_id' => $user->id,
        'channel_id' => $id,
        'customer_id' => optional($conversation)->customer_id,
        'partner_id' => optional($conversation)->partner_id,
    ]);

    if (!$conversation) return false;

     return in_array($user->id, [$conversation->customer_id, $conversation->partner_id]);
});
