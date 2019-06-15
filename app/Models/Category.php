<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name',
    	'icon',
    	'is_show',
    ];

    public function posts()
    {
    	return $this->hasMany(Post::class, 'category_id');
    }

    public function scopeEnabled($query)
    {
    	return $query->where('is_show', 1);
    }
}
