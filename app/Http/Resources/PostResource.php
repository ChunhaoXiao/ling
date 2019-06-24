<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'cover' => $this->picture_full_path,
            'price' => $this->price,
            'comment_count' => $this->comment_count,
            'post_type' => $this->post_type,
            'comments' => $this->comments,
            $this->mergeWhen(!empty($request->post), [
                'body' => $this->body,
                'pictures' => $this->postPics,
                'likes' => $this->total_likes,
                'my_like' => $this->mylike,
                'collection_count' => $this->collections_count,
                'my_collection' => $this->my_collection,
            ]),
            'video' =>  $this->when($this->post_type == 'video', $this->video_url),
            'cates' => 'aaaaaa'
        ];
    }

   
}
