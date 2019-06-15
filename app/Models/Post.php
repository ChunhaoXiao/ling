<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'title',
    	'price',
    	'sold_count',
    	'body',
    	'is_vip',
    	'category_id',
    	'time_reange_id',
    ];

    public function category()
    {
    	return $this->belongsTo(Category::class, 'category_id');
    }

    public function pictures()
    {
    	return $this->hasMany(PostPicture::class, 'post_id');
    }

    public function cover()
    {
        return $this->hasOne(PostPicture::class, 'post_id')->orderBy('id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }

    public function collections()
    {
        return $this->hasMany(Collection::class, 'post_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function updatePictures($datas)
    {
    	if(empty(array_filter($datas)))
    	{
    		return $this->pictures()->delete();
    	}
    	$existsPictures = $this->pictures->pluck('path')->toArray()??[];
    	$newPictures = array_diff($datas, $existsPictures);
    	$deletedPictures = array_diff($existsPictures, $datas);

    	if(!empty($newPictures))
    	{
            foreach($newPictures as $pic)
            {
                $newDatas[]['path'] = $pic;
            }
    		$this->pictures()->createMany($newDatas);
    	}
    	if(!empty($deletedPictures))
    	{
    		$this->pictures()->whereIn('path', array_values($deletedPictures))->delete();
    	}
    	return $this;
    }

    public function scopeVip($query, $vip)
    {
        return $query->has('pictures')->when($vip, function($query){
            $query->where('is_vip', 1);
        }, function($query){
            $query->where('is_vip', 0);
        });
    }

    public function scopeRecommend($query)
    {
        return $query->latest()->with('cover')->limit(6);
    }

    public function getPictureFullPathAttribute()
    {
        return $this->cover->path? asset(\Storage::url($this->cover->path)) : '';
    }

    public function getPostPicsAttribute()
    {
        return $this->pictures->map(function($item){
            return ['picture' => asset(\Storage::url($item->path))]; 
        });
    }
}
