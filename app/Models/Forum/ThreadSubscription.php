<?php

namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Model;

class ThreadSubscription extends Model
{
    protected $fillable = ['user_id', 'thread_id'];
}
