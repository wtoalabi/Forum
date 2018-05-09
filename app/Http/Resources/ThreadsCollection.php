<?php

namespace App\Http\Resources;

use App\Http\Resources\UserProfileResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ThreadsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($thread){
            //dd($thread['created_at'])->toDateTimeStringsw();
            return [
                "id"=> $thread->id,
                "slug"=> $thread->slug,
                "title"=> $thread->title,
                "body"=>$thread->body,
                "created_at" => $thread['created_at']->toDateTimeString(),
                "user" => new UserProfileResource($thread->user),
                "replies_count" => $thread->count()
                
            ];
        });
    }
}
