<?php

namespace App\Http\Middleware;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class ManagerMiddleware
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
        // check if the user is authenticated and he is a manager too.
        if (Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'manager') 
            return $next($request);
        else
            return redirect('/home');
    }
}
