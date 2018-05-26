<?php

namespace App\Http\Controllers\Admin;

use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LockThreadController extends Controller
{
    public function store ($threadID){
        $thread = Thread::find($threadID);
        
        if($thread->isLocked()){
            return $this->destroy($thread);
        }
        
        $thread->update(['locked'=>true]);
        return response(['message'=>"Thread was Locked!",'status'=>'Locked'],201);
    }

    protected function destroy ($thread){
        $thread->update(['locked'=>false]);
        return response(['message'=>"Thread was unLocked!", 'status'=>'unLocked'],201);
    }
}
