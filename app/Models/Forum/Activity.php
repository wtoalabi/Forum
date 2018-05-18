<?php

namespace App\Models\Forum;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable =['user_id', 'subject_title','type', 'subject_id', 'subject_type','object_id', 'object_type'];

    public function subject (){
        return $this->morphTo();
    }

    public function object (){
        return $this->morphTo();
    }
    public function user (){
         return $this->belongsTo(User::class);
    }
}
