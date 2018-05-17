<?php

namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable =['user_id', 'subject_title','type', 'subject_id', 'subject_type'];

    public function subject (){
        return $this->morphTo();
    }
}
