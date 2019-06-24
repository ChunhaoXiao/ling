<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\Recommend;

class RecommendController extends Controller
{
    public function index(Request $request)
    {
    	$datas = Post::vip($request->user()->is_vip())->recommend()->get();
    	return new Recommend($datas);
    	//return PostResource::collection($datas);
    }
}
