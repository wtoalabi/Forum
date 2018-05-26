<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SingleReplyResource;

class MarkReplyAsBestController extends Controller
{
    public function store (Reply $reply){
        
        if(auth()->user()->cant('update', $reply->thread)){
            return response(['message'=>"You are not authorized to mark this reply"], 403);
        }
        $reply->thread->markReplyAsBest($reply->id);
        return response(['message'=> "We have a winner!",'reply'=>new SingleReplyResource($reply)], 200);
    }
}
