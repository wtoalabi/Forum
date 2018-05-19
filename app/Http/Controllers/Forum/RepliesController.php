<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        
        $valid = $request->validate([
            'body' => "required"
        ]);
        $valid['user_id'] = Auth::user()->id;
        $valid['thread_id'] = $id;
        //dd($valid);
        $reply = Reply::create($valid);
        //return new SingleReplyResource($reply);
        return response(['status'=>200, 'message'=>'Done!', 'reply'=> new SingleReplyResource($reply)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $reply = Reply::find($id);

        if($reply->user_id == auth()->id()){
            $reply->update(['body'=>$request['body']]);
            //$reply->save();
            return response(['status'=>200, 'message'=>'Done!', 'reply'=> new SingleReplyResource($reply)]);
        }
        else{
            return "Not Authorized!";
        }
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
        if($reply->user_id == auth()->id()){
            $reply->delete();
            return response(["message" =>"Done", "replyID"=> $reply->id], 200);
        }
        return response(["message"=>"Not Authorized!"]);
        //return response(["message" =>"Done", "threadID"=> $thread->id;], 200);
    }
    
}
