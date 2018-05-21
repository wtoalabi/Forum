<?php

namespace App\Models\Forum;

use App\User;
use App\Notifications\ReplyWasAddedToThread;
use Illuminate\Database\Eloquent\Model;

class ThreadSubscription extends Model
{
    protected $fillable = ['user_id', 'thread_id'];

    public function user (){
         return $this->belongsTo(User::class);
    }

    public function notify ($reply){
         return $this->user->notify(new ReplyWasAddedToThread($reply->thread, $reply));
    }

    
}
