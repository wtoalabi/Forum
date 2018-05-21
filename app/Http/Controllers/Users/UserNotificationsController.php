<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationsCollection;

class UserNotificationsController extends Controller
{
    public function index (){
        return new NotificationsCollection(auth()->user()->notifications()->paginate(10));
    }
    
    public function destroy ($notificationID){
        return auth()->user()->notifications
                    ->find($notificationID)
                    ->markAsRead();
   }
}
