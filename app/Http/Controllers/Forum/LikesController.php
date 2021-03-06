<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LikesController extends Controller
{
    public function __construct (){
         return $this->middleware('auth');
    }
    public function likeThread ($thread){
        $user = Auth::user()->id;
        if(Redis::HGET("Threads:Thread-$thread", $user)){
            Redis::HDEL("Threads:Thread-$thread", $user);
            return 0;
        }
        else{
            Redis::HSET("Threads:Thread-$thread", $user, 1);
            return 1;
        }

    }
    public function likeReply ($reply){
        $user = Auth::user()->id;
        if(Redis::HGET("Replys:Reply-$reply", $user)){
            Redis::HDEL("Replys:Reply-$reply", $user);
            return 0;
        }
        else{
            Redis::HSET("Replys:Reply-$reply", $user, 1);
            return 1;
        }
    }

}
