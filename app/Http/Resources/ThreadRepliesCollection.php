<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ThreadRepliesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($reply){
            return [
                "id" => $reply->id,
                "body"=> $reply->body,
                "user"=> $reply->user->name,
                "created_at" => $reply['created_at']->diffForHumans()
            ];
        });
    }
}
