<?php

namespace App\Http\Resources;

use App\Models\Forum\Thread;
use App\Http\Resources\UserProfileResource;
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
                'type' =>$activity->type,
                'subject_title'=>$activity->subject_title,
                'created_at'=> $activity->created_at->diffForHumans(),
                'user'=> new UserProfileResource($activity->user),
                'subject' => $activity->subject,
                'object' => $activity->object,
                //'thread' => new ThreadReplyActivityResource(Thread::find($activity->object_id))
                    //'slug' => optional($activity->subject)->slug,
                    //'thread'=> optional($activity->thread)
            ];
        });
    }
}
