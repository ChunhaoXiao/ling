<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\PostComment;
use Auth;

class PostCommentController extends Controller
{
	public function index(Post $post)
	{
		$datas = $post->comments()->with('user')->with('replyto.user')->oldest()->paginate(5);
       //return $datas;
        return CommentResource::collection($datas);
	}

    public function store(CommentRequest $request, Post $post)
    {
    	$dataObj = $post->comments()->make($request->only('body', 'comment_id'));
    	$request->user()->comments()->save($dataObj);
    	$dataObj->refresh()->user;
    	return new CommentResource($dataObj);
    }

    public function destroy($id)
    {   
        $comment = Auth::user()->comments()->findOrFail($id);
        $comment->delete();
        return response()->json('success', 200);
    }	
}
