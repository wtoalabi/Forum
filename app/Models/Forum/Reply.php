<?php

namespace App\Models\Forum;

use App\User;
use Carbon\Carbon;
use App\Helpers\Likeable;
use App\Models\Forum\Thread;
use App\Models\Forum\Activity;
use App\Helpers\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Likeable;
    protected static function boot(){
        parent::boot();
        static::created(function($reply){
            Activity::create([
                'user_id'=> $reply->user->id,
                'subject_id'=> $reply->id,
                'subject_type' => get_class($reply),
                'object_id' => $reply->thread->id,
                'object_type' => get_class($reply->thread),
                'type'=> "created_reply"
            ]);
            $reply->thread->increment('replies_count');
        });
        
        static::deleting(function($reply){
            Activity::create([
                'user_id'=> $reply->user->id,
                'subject_id'=> $reply->id,
                'subject_type' => get_class($reply),
                'object_id' => $reply->thread->id,
                'object_type' => get_class($reply->thread),
                'type'=> "deleted_reply"
                ]);
            
            if($reply->thread->replies_count > 0){
               $reply->thread->decrement('replies_count');
            }

        });
          
    }
    protected $fillable = ['body', 'user_id', 'thread_id'];
    
    public function user (){
        return $this->belongsTo(User::class);
   }
    public function thread (){
        return $this->belongsTo(Thread::class);
    }   
    public function activity (){
        return $this->morphMany(Activity::class, 'subject');
    }

    public function wasJustPublished (){
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    public function setBodyAttribute ($body){
            $this->attributes['body'] = preg_replace('/@([\w\-]+)/', '<a href="forums#/profile/$1">$0</a> ', $body);
        }
    public function  isBest(){
        return $this->thread->best_reply_id == $this->id;
    }
}
