<?php

namespace App\Http\Resources;

use App\Http\Resources\ThreadRepliesCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleThreadResource extends JsonResource
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
            "id" => $this->id,
            "slug" => $this->slug,
            "title" => $this->title,
            "body" => $this->body,
            "owner" => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            "replies" => new ThreadRepliesCollection($this->replies),
            "created_at" => $this->created_at->diffForHumans()
        ];
    }
}
