<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use App\Jobs\UpdateExpiredVipMembers;
class CheckVipDate
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
        if(empty(Cache::get('vip_date_checked')))
        {
            UpdateExpiredVipMembers::dispatch();
            Cache::set('vip_date_checked', '1', 3600);
        }

        return $next($request);
    }
}
