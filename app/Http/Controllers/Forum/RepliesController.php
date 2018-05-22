<?php

namespace App\Http\Controllers\Forum;

use Exception;
use Carbon\Carbon;
use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ReplyFormRequest;
use App\Http\Resources\SingleReplyResource;
use App\Http\Resources\ThreadRepliesCollection;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Thread $thread)
    {
        $replies = Reply::where('thread_id', $thread->id)->latest()->paginate(2);
        return new ThreadRepliesCollection($replies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($threadID, Request $request, ReplyFormRequest $reply)
    {
        if(auth()->user()->cant('create', Reply::class)){
            return response("You are posting too fast! Slow down a bit ;)", 422);
        }

        $reply = $reply->persistIn($threadID);
        
        return response(['status'=>200, 'message'=>'Done!', 'reply'=> new SingleReplyResource($reply)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, ReplyFormRequest $replyRequest)
    
    {
        $reply = Reply::find($id);

        if(auth()->user()->cant('update', $reply)){
            return response("You are not authorized! ;)", 422);
        }

        $reply = $replyRequest->update($reply);

        return response(['status'=>200, 'message'=>'Done!', 'reply'=> new SingleReplyResource($reply)]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = Reply::find($id);

        if(auth()->user()->cant('update', $reply)){
            return response("You are not authorized! ;)", 422);
        }
        
        $reply->delete();
        return response(["message" =>"Done", "replyID"=> $reply->id], 200);
    }
    
}
