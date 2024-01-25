<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
             'id' => $this->id,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'details' => $this->details,
            'street' => $this->street,
            'image' => $this->image,
            'zip_code' => $this->zip_code,
            'city' => $this->city,
            'is_public' => $this->is_public,
            'event_join_users' => $this->EventJoinUser
        ];
    }
}
