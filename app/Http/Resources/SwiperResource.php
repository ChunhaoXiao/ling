<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SwiperResource extends JsonResource
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
            'picture' =>  asset(\Storage::url($this->cover->path)),
            'post_id' => $this->cover->post_id,
            'title' => $this->title,
        ];
    }
}
