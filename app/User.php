<?php

namespace App;

use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
use App\Models\Forum\Activity;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','confirmation_token','confirmed'
    ];

    protected $casts =[
        'confirmed' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function threads (){
         return $this->hasMany(Thread::class);
    }

    public function replies (){
         return $this->hasMany(Reply::class);
    }
    public function activities (){
         return $this->hasMany(Activity::class);
    }

    public function profileImage (){
        return asset($this->avatar_url ? "storage/$this->avatar_url" : 'storage/default.jpg');
    }

    public function threadCacheKey ($thread){
        return sprintf('user%s.visits.thread%s', $this->id, $thread->id);
    }

    public function lastReply (){
         return $this->hasOne(Reply::class)->latest();
    }

    
}
