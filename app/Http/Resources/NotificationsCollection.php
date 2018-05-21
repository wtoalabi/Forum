<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($notification){
            return [
                'id' => $notification->id,
                'type' => $notification->type,
                'notifiable_type' => $notification->notifiable_type,
                'notifiable_id' => $notification->notifiable_id,
                'data'=> $notification->data,
                'read_at'=> $notification->read_at,
                'created_at' => $notification->created_at->diffForHumans(),
                'userImage'=> User::find(optional($notification->data)['userID'])->profileImage()
            ];
        });
    }
    public function with($request)
    {
        return [
            'count' => [
                'unRead' => $this->where('read_at', null)->count()// $this->notifications()->count(),
            ],
        ];
    }
}
