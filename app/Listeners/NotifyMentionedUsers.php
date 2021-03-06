<?php

namespace App\Listeners;

use App\User;
use App\Events\ThreadReceivedReply;
use App\Notifications\YouWereMentioned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMentionedUsers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ThreadReceivedReply  $event
     * @return void
     */
    public function handle(ThreadReceivedReply $event)
    {
        preg_match_all('/@([\w\-]+)/', $event->reply->body, $matches);
        User::whereIn('username', $matches[1])
        ->get()
        ->each(function($user) use ($event){
            return $user->notify(new YouWereMentioned($event->reply)); 
        });
    }
}
