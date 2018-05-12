<?php

namespace App\Models\Forum;

use App\Models\Forum\Thread;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function threads (){
         return $this->hasMany(Thread::class);
    }
}
