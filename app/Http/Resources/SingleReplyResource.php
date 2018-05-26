<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleReplyResource extends JsonResource
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
            "body"=> $this->body,
            "user"=> $this->user->name,
            "user_id" => $this->user->id,
            "isBestReply" => $this->isBest(),
            "created_at" => $this['created_at']->diffForHumans(),
            "likes" =>[
                "like_count" => $this->likeCount(),
                "liked" => $this->liked(),
            ]
        ];
    }
}
