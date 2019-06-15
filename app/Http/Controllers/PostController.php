<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
    	$cate_id = $request->cate_id?? 0;
    	$datas = Post::vip(Auth::user()->is_vip())->when($cate_id > 0, function($query) use($cate_id)
    	{
    		$query->where('category_id', $cate_id);
    	})->with('cover')->latest()->paginate(7);
    	return PostResource::collection($datas);
    }

    public function show($id)
    {

    	$post = Post::with('pictures')->withCount(['likes as total_likes', 'likes as mylike' => function($query){
    		$query->where('user_id', Auth::id());
    	}, 'collections as collections_count', 'collections as my_collection', 'comments as comment_count'])->findOrFail($id);
    	$this->authorize('view', $post);
    	//$post->pictures;
    	return new PostResource($post);
    }
}
