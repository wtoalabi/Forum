<?php

namespace App\Models\Forum;

use App\Models\Forum\Thread;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];
    public function threads (){
         return $this->hasMany(Thread::class);
    }

    public function setSlugAttribute($slug){
         return $this->attributes['slug'] = str_slug($this->name, '-');
    }
}
