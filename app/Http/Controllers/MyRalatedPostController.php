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
        $user = Auth::user();
    	if($request->type == 'likes')
    	{
            $datas = $user->getLikes()->pluck('likeable');
    	}

    	elseif($request->type == 'collections')
    	{
            $datas = $user->getCollections()->pluck('post');
    	}

    	elseif ($request->type == 'comments') {
            $datas = $user->getCommented();
    		// $posts = Auth::user()->comments()->select('post_id')->groupBy('post_id')->paginate(10);
    		// $ids = $posts->pluck('post_id')->toArray();
    		// $datas = Post::whereIn('id', $ids)->with('cover')->get();
    	}
    	return PostResource::collection($datas);
    }
}
