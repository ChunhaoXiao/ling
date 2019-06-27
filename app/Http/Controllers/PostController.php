<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\PostCollection;
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
    	})->with(['cover', 'category'])->latest()->paginate(7);
    	return new PostCollection($datas);
    }

    public function show($id)
    {

    	$post = Post::with(['pictures', 'comments' => function($query){
            $query->with('user')->limit(5);
        }])->withCount(['likes as total_likes', 'likes as mylike' => function($query){
    		$query->where('user_id', Auth::id());
    	}, 'collections as collections_count', 'collections as my_collection', 'comments as comment_count'])->findOrFail($id);
    	$this->authorize('view', $post);
    	return new PostResource($post);
    }
}
