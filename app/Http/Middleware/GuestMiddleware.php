<?php

namespace App\Http\Middleware;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class GuestMiddleware
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
        // check if the user is not authenticated to make registration or login processes
        if (!Sentinel::check())
            return $next($request);
        else
            return redirect('/');
    }
}
