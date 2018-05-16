<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\SearchQueries\SortThreads;
use App\Http\Controllers\Controller;
use App\Http\Resources\ThreadsCollection;

class SortedThreadsController extends Controller
{
    public function index (SortThreads $query){
        $threads = Thread::sortBy($query)->paginate(20)->appends(request()->query());
        
        return new ThreadsCollection($threads);
    }
}
