<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [];

    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }
    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    public function scopeForUser($q, int $uid)
    {
        return $q->where(function ($q) use ($uid) {
            $q->where('user_one_id', $uid)->orWhere('user_two_id', $uid);
        });
    }
}
