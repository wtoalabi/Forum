<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MentionedUsersController extends Controller
{
    public function index (){
     $search = request('name');
        return User::where('username', 'LIKE',"%$search%")
                ->take(5)
                ->pluck('username');
    } 
}
