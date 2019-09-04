<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckActive
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
        if(Auth::user()->isActive === 0){
            Auth::logout();
        }
        return $next($request);
    }
}
