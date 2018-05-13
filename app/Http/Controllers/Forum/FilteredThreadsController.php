<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SearchQueries\ThreadsFilters;
use App\Http\Resources\ThreadsCollection;

class FilteredThreadsController extends Controller
{
    public function index (ThreadsFilters $filters){
        $threads = Thread::filter($filters)->paginate(10)->appends(request()->query());
        return new ThreadsCollection($threads);
    }
}