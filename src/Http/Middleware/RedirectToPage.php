<?php

namespace Hmones\LaravelRedirect\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectToPage
{
    public function handle(Request $request, Closure $next)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && Session::has('redirectLink')) {
                return redirect(Session::pull('redirectLink'));
            }
        }

        return $next($request);
    }
}
