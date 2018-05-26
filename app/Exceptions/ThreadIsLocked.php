<?php

namespace App\Exceptions;

use Exception;

class ThreadIsLocked extends Exception
{
    public function render (){
        return response(['message' => "Thread is locked!!!!"],422);
    }
}
