<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function create(User $user)
    {
        $lastReply = $user->fresh()->lastReply;
        if(!$lastReply) return true;
        return !$lastReply->wasJustPublished();
    }
}
