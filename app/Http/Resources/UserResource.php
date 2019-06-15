<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'like_count' => $this->like_count,
            'collection_count' => $this->collection_count,
            'name' => $this->name,
            'vm' => $this->vip? 'VIP会员到期时间:'.$this->vip->end_at->toDateString():'',
        ];
    }
}
