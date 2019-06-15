<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Post;
use App\Http\Resources\PostResource;

class MyRalatedPostController extends Controller
{
    public function index(Request $request)
    {
    	if($request->type == 'likes')
    	{
    		$datas = Auth::user()->likedPost()->with('likeable.cover')->paginate(10);
    		$datas = $datas->pluck('likeable');
    	}
    	elseif($request->type == 'collections')
    	{
    		$datas = Auth::user()->collections()->with('post.cover')->paginate(10);
    		$datas = $datas->pluck('post');
    	}
    	elseif ($request->type == 'comments') {
    		$posts = Auth::user()->comments()->select('post_id')->groupBy('post_id')->paginate(10);
    		$ids = $posts->pluck('post_id')->toArray();
    		$datas = Post::whereIn('id', $ids)->with('cover')->get();
    	}
    	return PostResource::collection($datas);
    }
}
