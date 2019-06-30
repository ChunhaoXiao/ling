<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'id' => $this->id,
            'user' => $this->user->name,
            'time' => (string)$this->created_at,
            'post' => $this->post->title,
            'to' => $this->replyto,
            'body' => $this->replyto ? '回复 @'.$this->replyto->user->name.' '.$this->body : $this->body,
            'is_me' => $this->user_id == $request->user()->id,
        ];
        //'replied_body' => $this->when($this->comment_id, ),
        //return parent::toArray($request);
    }
}
