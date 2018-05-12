<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryListCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($category){
            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'threads_count' => $category->threads_count
            ];
        });
    }
}