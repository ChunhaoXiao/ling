<?php

namespace App\Http\Middleware;

use Closure;
use Hash;
class CheckRequestKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = config('reqkey.key');
        if(!Hash::check($key, $request->key)){
            return response()->json(['msg' => '非法请求', 'status' => false]);
        }
        return $next($request);
    }
}
