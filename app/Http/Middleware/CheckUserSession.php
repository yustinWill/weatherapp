<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserSession
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
        if (!$request->session()->has('user_code') || !$request->session()->has('user_initial_name') || !$request->session()->has('user_name') || !$request->session()->has('user_role') || !$request->session()->has('user_email')) {
            return redirect("/");
        }
        return $next($request);
    }
}
