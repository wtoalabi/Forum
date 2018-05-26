<?php

namespace App\Models\Forum;

use App\User;
use Carbon\Carbon;
use App\Helpers\Likeable;
use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
use App\Models\Forum\Category;
use App\Helpers\RecordsActivity;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;
use App\Models\Forum\ThreadSubscription;

class Thread extends Model

{
    use Likeable, RecordsActivity;
    protected $casts = [
        'locked'=>'boolean'
    ];
    protected static function boot(){
        parent::boot();    
        static::created(function($thread){
            $thread->update(['slug'=>$thread->title]);
        });
        
    }
    protected $fillable = ['user_id', 'title', 'body', 'slug', 'locked','replies_count','category_id','best_reply_id'];
    protected $with = ['user','category'];
    
    public function user (){
         return $this->belongsTo(User::class);
    }
    
   public function replies (){
        return $this->hasMany(Reply::class);
        }
    public function getRouteKeyName(){
     return 'slug';
    }
    public function category (){
         return $this->belongsTo(Category::class);
    }

    public function scopeFilters ($query, $filters){
        return $filters->apply($query);
    }

    public function subscribe ($userID= null){
         $this->subscriptions()->create([
             'user_id' => $userID ?: auth()->id()
         ]);
    }

    public function isSubscribedTo (){
         return $this->subscriptions()->where('user_id', auth()->id())->exists();
            }

    public function unsubscribe ($userID = null){
         $this->subscriptions()
                ->where('user_id', $userID?:auth()->id())
                ->delete();
    }
    
    public function subscriptions(){
        return $this->hasMany(ThreadSubscription::class);
    }

    public function bestReply (){
        return $this->hasOne(Reply::class,'id', 'best_reply_id');
    }

    public function updatedSinceLastVisit ($user = null){
        $user = $user ? : auth()->user();
        if($user === null){
            return null;
        }

        $then = cache()->get($user->threadCacheKey($this));
        return $this->updated_at > $then;
    }

    public function path (){
         return sprintf("%s/%s", $this->category->slug, $this->slug);
    }
    public function visits (){
         $count = Redis::HMGET("Thread-Visits:Threads",$this->id)[0];
         return $count ?: "None";
    }

    public function setSlugAttribute($value){       
        $slug = str_slug($value);
        
        if(static::whereSlug($slug)->exists()){
            $slug = "{$slug}-{$this->id}";

        }
        return $this->attributes['slug'] = $slug;
    }
    public function markReplyAsBest ($replyID){
         return $this->update(['best_reply_id' => $replyID]);
    }

    public function isLocked (){
         return $this->locked;
    }

    public function wasJustPublished (){
         return $this->created_at->gt(Carbon::now()->subMinute());
    }
}