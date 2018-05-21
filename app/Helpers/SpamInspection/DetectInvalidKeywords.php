<?php
namespace App\Helpers\SpamInspection;

use Exception;

class DetectInvalidKeywords
{
    protected $invalidKeywords = [
        'yahoo customer support'
    ];

    public function detect ($body){
        
        foreach($this->invalidKeywords as $keyword){
            
            if(stripos($body, $keyword) !== false){
                throw new Exception("You have spam!");
            }
        }
    }
}