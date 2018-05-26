<?php

namespace App\Exceptions;

use Exception;

class IsNotAdminException extends Exception
{
    public function render (){
        return response(['message' => "You are not an admin, therefore, not authorized to take this action!"],422);
    }
}
