<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
    	'post_id',
    	'user_id',
    	'likeable_type',
    	'likeable_id',
    ];

    public function likeable()
    {
    	return $this->morphTo();
    }
}
