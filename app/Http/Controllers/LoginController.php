<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
class LoginController extends Controller
{
    public function store(Request $request, User $user)
    {
    	$code = $request->code;
        $client = new Client;
        $appid = env('SMALL_PROGRAM_APPID');
        $secret = env('SMALL_PROGRAM_SECRET');

        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$code."&grant_type=authorization_code";
        $response = $client->request('GET', $url)->getBody();
        $openid = json_decode($response, true)['openid'];
        return $user->saveUser($openid);
    }

    public function update(Request $request)
    {

    }
}
