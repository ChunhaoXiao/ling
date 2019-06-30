<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\PostComment;
use App\Http\Resources\ReplyResource;
use App\Events\RepliesRead;
class ReplyController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$datas = $user->comments()->whereHas('replied')->pluck('id');
    	$datas = PostComment::whereIn('comment_id', $datas)->with(['user', 'post.cover', 'replyto.user', 'replyto.replyto.user'])->orderBy('viewed')->orderBy('id','desc')->paginate(5);
    	event( new RepliesRead($datas) );

    	return ReplyResource::collection($datas);
    }
}
