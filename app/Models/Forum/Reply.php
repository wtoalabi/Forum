<?php

namespace App\Models\Forum;

use App\User;
use App\Models\Forum\Thread;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function user (){
        return $this->belongsTo(User::class);
   }
   public function thread (){
    return $this->belongsTo(Thread::class);
}
}
