<?php

namespace App\Http\Controllers\Forum;

use Carbon\Carbon;
use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QueryFilters\ThreadsFilters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Http\Resources\ThreadsCollection;
use App\Http\Resources\SingleThreadResource;
use App\Http\Resources\NewlyCreatedThreadResource;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ThreadsFilters $filters)
    {
        $threads = Thread::filters($filters)
                            ->latest()
                            ->paginate(10)
                            ->appends(request()->query());
        return new ThreadsCollection($threads);
    }

    public function trending (){
         return array_map('json_decode', Redis::zrevrange("Trending:Threads", 0, 4));     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [ 
            'title' => "required|spamfree", 
            'body' => "required|spamfree|toofast", 
            'category_id' => 'required|exists:categories,id'
        ];
        $message = [ 
            'category_id.required' => "You need to select a category!" ,
            'title.spamfree' => "Spam Alert! Please check and try again!",
            'body.spamfree' => "Spam Alert! Please check and try again!",
            'body.toofast' => 'You are posting too fast....take a break buddy!',
        ];
        $valid = $this->validate(request(), $rules, $message);
        $valid['user_id'] = Auth::user()->id;
        $thread = Thread::create($valid);
        return new NewlyCreatedThreadResource($thread);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $slug)
    {
        cache()->forever(auth()->user()->threadCacheKey($slug), Carbon::now());
        Redis::HINCRBY("Thread-Visits:Threads", $slug->id, 1);
        Redis::zincrby('Trending:Threads', 1, json_encode([
            'title'=>$slug->title,
            'slug'=> $slug->path()
        ]));
        return new SingleThreadResource($slug);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread)
    {
        $thread = Thread::find($thread);
        if($thread->user_id == auth()->id()){
            $thread->delete();
            return response(["message" =>"Done", "threadID"=> $thread->id], 200);
        }
        return response(["message"=>"Not Authorized!"]);
    }
}