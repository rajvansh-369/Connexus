<?php

namespace App\Livewire;

use App\Models\Chat as ModelsChat;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class Chat extends Component
{
    public $chat = [];
    public $message = '';
    public $receiverId = 0;
    public $sentMessages;
    public $receivedMessages;
    public $allMessages;
    public $user;
    public $chatWindowUser;
    public $getChatLists;
    public $chatId;
    public $sending;

    protected $listeners = ['livewireMessageReceived'];


    public function mount()
    {

        $this->user = auth()->user();
        $this->sentMessages = $this->user->fromMessages;
        $this->receivedMessages = $this->user->toMessages;
        $this->allMessages = $this->user->allMessages();
        //   dd($this->allMessages);

        $this->getChatLists =  User::where("id", "!=", $this->user->id)->get();
        // $this->receiverId =  $this->getChatLists->where('to_user_id', '!=', $this->user->id)->first()->to_user_id ?? 8;
        // $this->chatWindowUser = ModelsChat::findOrFail($this->receiverId);

        $this->chatId = ModelsChat::first()->id;


        // dd($this->chatId, $other, auth()->id());

        // dd($this->getChatLists->where('to_user_id' , '!=', $this->user->id)->first(),$this->user->id);
    }


    public function setreceiverId($id)
    {
        $this->receiverId =  $id;
    }

    #[On('updateChatWindow')]
    public function updatePostList($chatId)
    {
        $this->chatId = $chatId;
        $this->chatWindowUser = ModelsChat::findOrFail($this->chatId);
        $this->receiverId =  $this->chatWindowUser->user_two_id == auth()->user()->id ? $this->chatWindowUser->user_one_id : $this->chatWindowUser->user_two_id;
        // dd($this->chatWindowUser);
    }

    public function sendMessage()
    {


        if ($this->sending) return;  // guard
        $this->sending = true;

        if ($this->message != "") {
            $me = auth()->id();
            $chat = ModelsChat::find($this->chatId);

            // dd($chat,$this->receiverId, $this->chatId);
            $messageData = [
                'chat_id' => $chat->id,
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $this->receiverId,
                'message' => $this->message,
                'message_time' => Carbon::now(),
                'is_deleted' => 0,
            ];


            try {
                // validate, persist, broadcast...
                event(new \App\Events\MessageSent($messageData));
            } finally {
                $this->sending = false;
            }
            // dd($messageData);

            // event(new \App\Events\TestBroadcast('Hello World from broadcast!'));


            if (!$chat) {

                $chatCreate = ModelsChat::create([
                    'user_one_id' => auth()->user()->id,
                    'user_two_id' => $this->receiverId,
                    'last_message' => $this->message,
                    'last_activity' => now()
                ]);

                Message::create([
                    'chat_id' => $chatCreate->id,
                    'from_user_id' => auth()->user()->id,
                    'to_user_id' => $this->receiverId,
                    'message' => $this->message,
                    'message_time' => Carbon::now(),
                    'is_deleted' => 0,
                ]);
            } else {

                // dd($chat);
                Message::create([
                    'chat_id' => $chat->id,
                    'from_user_id' => auth()->user()->id,
                    'to_user_id' => $this->receiverId,
                    'message' => $this->message,
                    'message_time' => Carbon::now(),
                    'is_deleted' => 0,
                ]);
            }

            $this->sentMessages = $this->user->fromMessages;
            $this->receivedMessages = $this->user->toMessages;
            $this->allMessages = $this->user->allMessages();
            $this->message = "";
        }
    }

    public function livewireMessageReceived($message)
    {
        $this->sentMessages = $this->user->fromMessages;
        $this->receivedMessages = $this->user->toMessages;
        $this->allMessages = $this->user->allMessages();
        $this->message = "";
        // $msg = ModelsChat::make($message);     // hydrate a model instance
        // $msg->setRelation('user', $msg->fromUser()->first()); // or: $msg->load('user') if it has an id
        // $this->allMessages->push($msg);
    }


    public function render()
    {
        return view('livewire.chat');
    }
}
