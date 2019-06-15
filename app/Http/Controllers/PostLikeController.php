<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class PostLikeController extends Controller
{
    public function store(Request $request)
    {
    	$user_id = Auth::id();
    	$post = Post::findOrFail($request->post_id);
    	if($like = $post->likes()->where('user_id', $user_id)->first())
    	{
    		$like->delete();
    		return -1;
    	}

    	$post->likes()->create([
    		'user_id' => Auth::id(),
    	]);
    	return 1;
    }
}
