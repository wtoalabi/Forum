<?php
namespace App\Helpers\Spams;

use Exception;

class Spam{
    public function detect ($body){
         return $this->detectInvalidKeywords($body);
    }

    public function detectInvalidKeywords ($body){
         $invalidKeyWords=[
             'yahoo customer support'
         ];

         foreach($invalidKeyWords as $keyword){
             if(stripos($body, $keyword) !== false){
                 throw new Exception("You have spam!");
             }
         }
         return false;
    }
}