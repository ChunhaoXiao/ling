<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;


class RecommendController extends Controller
{
    public function index(Request $request)
    {
    	$datas = Post::vip($request->user()->is_vip())->recommend()->get();
    	return PostResource::collection($datas);
    }
}
