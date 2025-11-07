<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;

class ChatList extends Component
{

    public $getChatLists;
    public $user;
    public function mount()
    {

        $this->user = auth()->user();
        // dd($this->user );
        // $this->getChatLists = Chat::where("user_one_id", $this->user->id)->orWhere("user_two_id", $this->user->id)->get();


        $me = auth()->id();

        $chats = Chat::forUser($me)
            ->with(['userOne:id,name,profile_image', 'userTwo:id,name,profile_image'])
            ->orderByDesc('last_activity')
            ->get();

        $this->getChatLists = $chats->map(function ($chat) use ($me) {
            $other = $chat->user_one_id === $me ? $chat->userTwo : $chat->userOne;
            // dd($other);
            return [
                'chat_id' => $chat->id,
                'other_user_id' => $other->id,
                'other_user_name' => $other->name,
                'profile_image' => $other->profile_image,
                'last_message' => $chat->last_message,
                'last_activity' => $chat->last_activity,
            ];
        });
        // dd($this->getChatLists);
    }

    public function openChat($chatId)
    {

        // dd($chatId);
        $this->dispatch('updateChatWindow', chatId: $chatId);
    }

    public function render()
    {
        return view('livewire.chat-list');
    }
}
