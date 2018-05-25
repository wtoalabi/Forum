<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotConfirmed
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
        if($request->user()->confirmed == false){
            return response('You need to confirm your email address first. Thanks',422);
        }
        return $next($request);
    }
}
