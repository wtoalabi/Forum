<?php

namespace App\Models\Forum;

use App\User;
use App\Helpers\Likeable;
use App\Models\Forum\Reply;
use App\Models\Forum\Category;
use App\Helpers\RecordsActivity;
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

    public function scopeSortBy ($query, $sort){
         return $sort->by($query);
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
    

}