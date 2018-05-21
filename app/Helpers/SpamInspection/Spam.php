<?php
namespace App\Helpers\SpamInspection;

use Exception;
use App\Helpers\SpamInspection\KeyHeldDown;
use App\Helpers\SpamInspection\DetectInvalidKeywords;

class Spam
{
    protected $inspections = [
        DetectInvalidKeywords::class,
        KeyHeldDown::class
    ];
    
    public function detect ($body){
        foreach($this->inspections as $inspection){
            app($inspection)->detect($body);
        }
        return false;
    }

    
}