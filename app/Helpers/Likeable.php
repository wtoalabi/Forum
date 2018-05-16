<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Redis;

Trait Likeable{
    
        public function likeCount (){
            return Redis::HLEN($this->classPathOnRedis() . $this->id);
        }
        
        public function liked (){
            if(auth()->id()){
                return Redis::HEXISTS($this->classPathOnRedis().$this->id, auth()->user()->id);
            }
            else{
                return 0;
            }
        }
        
        protected function classPathOnRedis (){
        $name = get_class($this);
        $arrayOfPath = explode('\\',$name);
        $className = array_pop($arrayOfPath);
        return $className. 's:'. $className.'-';
   }
}