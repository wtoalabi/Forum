<?php

namespace App\Http\Resources;

use App\Models\Forum\Reply;
use App\Models\Forum\Category;
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
            "subscribedTo" => $this->isSubscribedTo(),
            "owner" => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
                'threads_count' => Category::find($this->category->id)->threads()->count(),
            ],
            "created_at" => $this->created_at->diffForHumans()
        ];
    }
}
