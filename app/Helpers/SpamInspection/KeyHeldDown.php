<?php
namespace App\Helpers\SpamInspection;

use Exception;

class KeyHeldDown
{
    public function detect ($body){
         if(preg_match('/(.)\\1{4,}/' ,$body)){
             throw new Exception("You cant hold a key down for long...check your text again.");
         }
    }
}