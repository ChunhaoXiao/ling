<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserVipRequest;

class UserVipController extends Controller
{
    public function store(UserVipRequest $requset)
    {
    	$datas = $requset->all();
    	$user = User::whereName($datas['name'])->first();
    	$user->updateVip($datas['month']);
    	return response()->json('success', 200);
    }
}
