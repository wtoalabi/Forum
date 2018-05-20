<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThreadsSubscriptionController extends Controller
{
    public function store ($threadID){
         $thread = Thread::find($threadID);
         $thread->subscribe();
         return 1;
    }

    public function destroy ($threadID){
        $thread = Thread::findOrFail($threadID);
        $thread->unsubscribe();
        return 1;
    }
}
