<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends Controller
{
    public function store (){
        
        if(auth()->user()->cant('update', auth()->user())){
            return response("Wait..what are you doing? ;)", 422);
        }

        $valid = request()->validate([
            'avatar' => 'required|image'
        ]);
        
        $ext = request()->file('avatar')->getClientOriginalExtension();
        $name = time() . str_random();
        $user = auth()->user();
        $avatar = request()->file('avatar')->storeAs('avatar/'.$user->id, "$name.$ext", 'public');
        
        if($user->avatar_url){
            Storage::disk('public')->delete($user->avatar_url);
            $user->avatar_url = null;
        }
        $user->avatar_url = $avatar;
        $user->save();
        return "DONE";
    }
}
