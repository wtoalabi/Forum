<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Redis;

Trait Likeable{
    public function likeCount (){
        $className = $this->getClassName();
        return Redis::HLEN($className. 's:'. $className.'-'.$this->id );
   }

   protected function getClassName (){
    $name = get_class($this);
    $arrayOfPath = explode('\\',$name);
    return array_pop($arrayOfPath);
   }
}