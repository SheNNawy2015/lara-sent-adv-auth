<?php

namespace App\Http\Middleware;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class UserMiddleware
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
         // check if the user is authenticated
        if (Sentinel::check())
            return $next($request);
        else
            return redirect('/login');
    }
}
