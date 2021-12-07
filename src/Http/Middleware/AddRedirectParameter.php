<?php

namespace Hmones\LaravelRedirect\Http\Middleware;

use Closure;
use Hmones\LaravelRedirect\Http\Requests\RedirectRequest;
use Hmones\LaravelRedirect\RedirectConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AddRedirectParameter
{
    use RedirectConfiguration;

    public function handle(Request $request, Closure $next)
    {
        if ($this->parameterEnabled() && $request->has($this->parameterName())) {
            Cookie::queue('previousUrl', app(RedirectRequest::class)->getParameterUrl());
        }

        return $next($request);
    }
}
