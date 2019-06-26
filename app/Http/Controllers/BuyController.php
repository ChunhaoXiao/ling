<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BuyController extends Controller
{
    public function store(Request $request)
    {
    	$username = $request->username;
    	$user = User::whereName($username)->first();
    	if(!$user)
    	{
    		return response()->json(['status' => false, 'msg' => '用户不存在']);
    	}
    	$res = $user->updateVip($request->month);
    	if(!$res)
    	{
    		return response()->json(['status' => false, 'error' => '操作失败']);
    	}

    	return response()->json(['status' => true], 200);

    }


}
