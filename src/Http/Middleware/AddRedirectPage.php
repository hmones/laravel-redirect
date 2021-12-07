<?php

namespace Hmones\LaravelRedirect\Http\Middleware;

use Closure;
use Hmones\LaravelRedirect\RedirectConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AddRedirectPage
{
    use RedirectConfiguration;

    public function handle(Request $request, Closure $next)
    {
        if (Auth::guest() && ! in_array($request->url(), $this->excludedRoutes())) {
            Cookie::queue('previousUrl', $request->url());;
        }

        return $next($request);
    }
}
