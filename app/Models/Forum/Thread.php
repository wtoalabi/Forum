<?php

namespace App\Models\Forum;

use App\User;
use App\Helpers\Likeable;
use App\Models\Forum\Reply;
use App\Models\Forum\Category;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model

{
    use Likeable;
    protected $fillable = ['user_id', 'title', 'body', 'slug', 'category_id'];
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

    public function scopeFilter ($query, $filters){
        return $filters->apply($query);
    }

    public function scopeSortBy ($query, $sort){
         return $sort->by($query);
    }

    
 

}