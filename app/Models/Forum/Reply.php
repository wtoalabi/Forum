<?php

namespace App\Models\Forum;

use App\User;
use App\Helpers\Likeable;
use App\Models\Forum\Thread;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Likeable;
    protected $fillable = ['body', 'user_id', 'thread_id'];
    public function user (){
        return $this->belongsTo(User::class);
   }
   public function thread (){
    return $this->belongsTo(Thread::class);
}
}
