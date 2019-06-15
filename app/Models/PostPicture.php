<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostPicture extends Model
{
    protected $fillable = [
    	'path',
    	'is_cover',
    	'post_id',
    ];

    public function post()
    {
    	return $this->belongsTo(Post::class, 'post_id');
    }
}
