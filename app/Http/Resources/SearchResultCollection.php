<?php

namespace App\Http\Resources;

use App\Http\Resources\SingleSearchResult;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchResultCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($result){
            return new SingleSearchResult($result);
        });
    }
}
