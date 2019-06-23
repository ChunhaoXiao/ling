<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = [
    	'post_id',
    	'body',
    	'user_id',
    	'comment_id',
    ];

    public function post()
    {
    	return $this->belongsTo(Post::class, 'post_id')->withDefault();
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
