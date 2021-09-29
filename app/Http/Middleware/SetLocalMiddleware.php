<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $desiredLocale=$request->segment(1);
        in_array($desiredLocale, ["en", "ur"]) ? app()->setLocale($desiredLocale) : app()->setLocale('en');

        return $next($request);
    }
}
