<?php

namespace App\Helpers;

use App\Models\Forum\Activity;

Trait RecordsActivity{
    
    protected static function bootRecordsActivity(){
        if(auth()->guest()) return;
        foreach(static::getActivitiesToRecord() as $event){
            static::$event(function($model) use ($event){
                $model->recordActivity($event);
            });
        }
    }

    public static function getActivitiesToRecord(){
        return ['created','deleted'];
    }
    protected function recordActivity($event){
        $this->activity()->create([
            'user_id'=> auth()->id(),
            'subject_title'=> $this->title,
            'type'=> $this->getActivityType($event),
        ]);
    }      
    
    protected function getActivityType($event){
        $type = strtolower((new \ReflectionClass($this))->getShortname());
        return "{$event}_{$type}";
    }
    public function activity (){
        return $this->morphMany(Activity::class, 'subject');
   }
}
