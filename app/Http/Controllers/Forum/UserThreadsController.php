<?php

namespace App\Http\Controllers\Forum;

use App\User;
use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ThreadsCollection;

class UserThreadsController extends Controller
{
    public function index (Request $request, $username){
        $user = User::whereUsername($username)->first();
        $threads = Thread::where('user_id', $user->id)->latest()->get();
        return new ThreadsCollection($threads);
        
   }
}