<?php

namespace Hmones\LaravelRedirect\Http\Middleware;

use Closure;
use Hmones\LaravelRedirect\RedirectConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RedirectToPage
{
    use RedirectConfiguration;

    public function handle(Request $request, Closure $next)
    {
        if (Cookie::has('previousUrl') && $request->url() === $this->defaultRoute()) {
            return redirect(tap(Cookie::get('previousUrl'), function () {
                Cookie::expire('previousUrl');
            }));
        }

        return $next($request);
    }
}
