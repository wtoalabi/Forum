<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserActivitiesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($activity){
            return [
                'user_id' => $activity->id,
                'activity_subject_id' =>$activity->subject_id,
                'activity_subject_id' =>$activity->subject_id,
                'activity_subject_title' => $activity->subject_title,
                'activity_type' =>$activity->type,
                'activity_created_at'=> $activity->created_at->diffForHumans(),
                'activity_subject'=> $activity->subject
            ];
        });
    }
}
