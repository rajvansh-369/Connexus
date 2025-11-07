<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


// Broadcast::channel('chat', function ($user) {
//     return true; // or add auth logic
// });

// Broadcast::channel('chat.{userId}', function ($user, $userId) {
//     return (int) $user->id === (int) $userId;
// });

// Broadcast::channel('chat.{userId}', fn() => true);

Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
    \Log::info('Broadcast auth check', ['auth_id' => $user?->id, 'chan_id' => $roomId]);
    // return (int) $user->id === (int) $userId;

    return Chat::where('id', $roomId)
        ->where(function ($q) use ($user) {
            $q->where('user_one_id', $user->id)
              ->orWhere('user_two_id', $user->id);
        })->exists();
});
