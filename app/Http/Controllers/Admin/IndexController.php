<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Support\Facades\Redis;

use App\Http\Resources\Recommend;

class IndexController extends Controller
{
    public function index()
    {
    	//phpinfo();
    	//echo Cache::get('vip_date_checked');
    	return view('admin.index.index');
    }


    public function test()
    {
    	$datas = \App\Models\Post::where('post_type','picture')->latest()->limit(4)->get();
    	return new Recommend($datas);
    }
}
