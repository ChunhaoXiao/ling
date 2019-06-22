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
    	//echo Cache::get('vip_date_checked');
    	return view('admin.index.index');
    }
}
