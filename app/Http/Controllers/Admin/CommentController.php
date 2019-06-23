<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostComment;

class CommentController extends Controller
{
    public function index()
    {
    	$datas = PostComment::with('post')->latest()->paginate(25);
    	return view('admin.comment.index', ['datas' => $datas]);
    }

    public function destroy(PostComment $comment)
    {
    	$comment->delete();
    	return response()->json('success', 200);
    }
}
