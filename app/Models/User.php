<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function chatList()
    // {

    //     $userId = $this->id; // current user id
    //     // dd($userId);
    //     // Get latest chat for each user conversation partner (grouped by to_user_id)
    //     return Message::select('to_user_id', DB::raw('MAX(created_at) as latest_message_time'))
    //         ->where('from_user_id', $userId)
    //         ->groupBy('to_user_id')
    //         ->orderBy('latest_message_time', 'desc')
    //         ->get();
    // }

    public function fromMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id', 'id');
    }

    public function toMessages()
    {
        return $this->hasMany(Message::class, 'to_user_id', 'id');
    }

    public function allMessages()
    {
        $sent = $this->toMessages()->get();
        $received = $this->fromMessages()->get();
        // dd($sent,$received );
        return $sent->merge($received)->sortBy('created_at');
    }
  
    public function senderChatUser()
    {
        return $this->hasOne(Chat::class, 'user_one_id', 'id');
    }

     public function receiverChatUser()
    {
        return $this->hasOne(Chat::class, 'user_two_id', 'id');
    }

}
