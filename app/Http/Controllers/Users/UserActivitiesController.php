<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use App\Models\Forum\Activity;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserActivitiesCollection;

class UserActivitiesController extends Controller
{
    public function index ($user){
        $user = User::where('username', $user)->first();
        $activities = Activity::where('user_id', $user->id)->latest()->paginate(3);
        return new UserActivitiesCollection($activities);
    }
}
