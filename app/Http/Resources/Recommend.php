<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Recommend extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'recommend' => PostResource::collection($this->collection)
        ];
    }


    public function with($request)
    {
        //$user = \Auth::guard('api')->user();
        return [
            'category' => Category::collection(\App\Models\Category::all()),
            'swiper' => SwiperResource::collection(\App\Models\Post::vip($request->user()->vip()->exists())->where('post_type', 'picture')->with('cover')->limit(5)->latest()->get()),
        ];
    }
}
