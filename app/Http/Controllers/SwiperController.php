<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\SwiperResource;
use Auth;

class SwiperController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$datas = Post::vip($user->vip()->exists())->with('cover')->limit(5)->latest()->get();
    	return SwiperResource::collection($datas);
    }
}
