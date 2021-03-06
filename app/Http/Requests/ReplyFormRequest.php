<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
use App\Exceptions\ThreadIsLocked;
use App\Events\ThreadReceivedReply;
use Illuminate\Foundation\Http\FormRequest;

class ReplyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => "required|spamfree|toofast"
        ];
    }


    public function messages (){
         return[
             'title.spamfree'=> "Spam Alert! Check your title",
             'body.spamfree'=> "Spam Alert! Check the body again!",
             'body.toofast' => 'You are posting too fast....take a break buddy!',
         ];
    }

    public function persistIn ($threadID){    
        
        $thread = Thread::find($threadID);
        
        if($thread->isLocked()){
            throw new ThreadIsLocked;
        }
        
        $reply = Reply::create([
            'body' => request('body'),
            'user_id' => $this->user()->id,
            'thread_id'=> $thread->id,
        ]); 

        cache()->forever($this->user()->threadCacheKey($thread), Carbon::now());
        
        event(new ThreadReceivedReply($reply));
        
        return $reply;
    }

    public function update ($reply){
        
        $reply->update(['body'=>request('body')]);  
        return $reply;
    }
}
