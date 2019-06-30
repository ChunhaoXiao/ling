<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'reply_msg' => $this->user->name.' 评论了 我：'. $this->body,
            'time' => (string)$this->created_at,
            'replied_msg' => $this->replyto->replyto? '我 评论了 '.$this->replyto->replyto->user->name.': '.$this->replyto->body : '我： '.$this->replyto->body,
            'id' => $this->id,
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'post_cover' => $this->post->picture_full_path,
            'viewed' => $this->viewed,
        ];
    }
}
