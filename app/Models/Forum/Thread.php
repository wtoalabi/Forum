<?php

namespace App\Models\Forum;

use App\User;
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
    protected static function boot(){
        parent::boot();    
        
    }
    protected $fillable = ['user_id', 'title', 'body', 'slug', 'replies_count','category_id'];
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
         
        if(static::whereSlug( $slug= str_slug($value))->exists()){
            $slug = $this->incrementSlug($value);
        }
        
        
        return $this->attributes['slug'] = $slug;
    }
    
    public function incrementSlug($value){
        
        $max = Thread::whereTitle($this->title)->latest()->value('slug');
            if(is_numeric($max[-1])){
                return preg_replace_callback('/(\d+)$/', function($matches){
                    return $matches[1] + 1;
                }, $max);
        }

        return "{$value}-2";
    }
    public static function generateSlug ($title){        
        
        $lastCharacter= Thread::where('title', $title)->latest()->value('slug')[-1];        
        $lastSlug='';
        {
            //$lastCharacter = $titles->last()->slug[-1]; //collect(str_split($titles->last()->slug))->last();
            if(is_numeric($lastCharacter)){
                $lastSlug = $lastCharacter + 1;
            }
            else{
                $lastCharacter ? $lastSlug = 2 : '';
            }
        }
        return str_slug($title.'-'.$lastSlug, '-');
    }
    

}