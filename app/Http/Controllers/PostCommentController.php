<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CommentRequest;

class PostCommentController extends Controller
{
	public function index(Post $post)
	{
		return $post->comments()->with('user')->paginate(5);
	}

    public function store(CommentRequest $request, Post $post)
    {
    	$dataObj = $post->comments()->make($request->only('body', 'comment_id'));
    	$request->user()->comments()->save($dataObj);
    	$dataObj->refresh()->user;
    	return $dataObj;
    }	
}
