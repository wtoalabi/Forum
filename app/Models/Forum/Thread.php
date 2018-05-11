<?php

namespace App\Models\Forum;

use App\User;
use App\Models\Forum\Reply;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'slug'];
    public function user (){
         return $this->belongsTo(User::class);
    }
    
   public function replies (){
    return $this->hasMany(Reply::class);
}
public function getRouteKeyName(){
     return 'slug';
}
}