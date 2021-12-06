<?php

namespace Hmones\LaravelRedirect\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddRedirectLink
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guest()) {
            Session::add('redirectLink', $request->fullUrl());
            $request->merge(['redirect' => $request->fullUrl()]);
        }

        return $next($request);
    }
}
