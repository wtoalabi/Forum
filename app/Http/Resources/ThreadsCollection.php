<?php

namespace App\Http\Resources;

use App\Http\Resources\UserProfileResource;
use App\Http\Resources\CategoryListCollection;
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
                "created_at" => $thread['created_at']->diffForHumans(),
                "user" => new UserProfileResource($thread->user),
                "replies_count" => $thread->replies_count,
                "updatedSinceLastVisit" => $thread->updatedSinceLastVisit(auth()->user()),
                'likes' => [
                    "like_count" => $thread->likeCount(),
                    "liked" => $thread->liked()
                ],
                "category" => [
                    'id'=> $thread->category->id,
                    'name'=> $thread->category->name,
                    'slug' => $thread->category->slug
                ],

            ];
        });
    }
}
