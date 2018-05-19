<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QueryFilters\ThreadsFilters;
use Illuminate\Support\Facades\Auth;
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
    public function store(Request $request)
    {
        $rules = [ 
            'title' => "required", 
            'body' => "required", 
            'category_id' => 'required|exists:categories,id'
        ];
        $message = [ 
            'category_id.required' => "You need to select a category!" 
        ];
        $valid = $this->validate(request(), $rules, $message);
        
        $valid['slug'] = str_slug($request['title'], '-');
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
        return new SingleThreadResource($slug);

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
        //return response(["message" =>"Done", "threadID"=> $thread->id;], 200);
    }
}