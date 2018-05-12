<?php

namespace App\Http\Resources;

use App\Http\Resources\UserProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NewlyCreatedThreadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "slug"=> $this->slug,
            "title"=> $this->title,
            "body"=>$this->body,
            "created_at" => $this['created_at']->diffForHumans(),
            "user" => new UserProfileResource($this->user),
            "replies_count" => $this->replies()->count(),
            "category" => [
                'id'=> $this->category->id,
                'name'=> $this->category->name,
                'slug' => $this->category->slug
            ],
            
        ];
    }
}
