<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Support\Facades\Redis;



class IndexController extends Controller
{
    public function index()
    {
    	Redis::set('name', 'xiao');
    	dump(Redis::get('name'));
    	return view('admin.index.index');
    }
}
