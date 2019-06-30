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
        'viewed',
    ];

    public function post()
    {
    	return $this->belongsTo(Post::class, 'post_id')->withDefault();
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }


    //一个或0个
    public function replyto()
    {
        return $this->belongsTo(PostComment::class, 'comment_id')->withDefault([]);
    }

    public function replied()
    {
        return $this->hasMany(PostComment::class, 'comment_id');
    }
}
