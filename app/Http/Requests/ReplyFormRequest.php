<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
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
            'body' => "required|spamfree"
        ];
    }


    public function messages (){
         return[
             'title.spamfree'=> "Spam Alert! Check your title"
             'body.spamfree'=> "Spam Alert! Check the body again!"
         ];
    }

    public function persistIn ($threadID){    
        $thread = Thread::find($threadID);

        $reply = Reply::create([
            'body' => request('body'),
            'user_id' => $this->user()->id,
            'thread_id'=> $thread->id,
        ]); 

        cache()->forever($this->user()->threadCacheKey($thread), Carbon::now());

        $thread->subscriptions->filter(function($sub) use($reply){
            return $sub->user_id == $reply->user_id;
        })->each->notify($reply);
        
        return $reply;
    }

    public function update ($reply){
        
        $reply->update(['body'=>request('body')]);  
        return $reply;
    }
}
