<?php

namespace Hmones\LaravelRedirect;

trait RedirectConfiguration
{
    protected function parameterRegex(): ?string
    {
        return config('laravel-redirect.parameter.regex');
    }

    protected function parameterName(): ?string
    {
        return config('laravel-redirect.parameter.name');
    }

    protected function excludedRoutes(): array
    {
        return [
            route(config('laravel-redirect.routes.login')),
            route(config('laravel-redirect.routes.default')),
            route(config('laravel-redirect.routes.logout')),
        ];
    }

    protected function parameterEnabled(): ?bool
    {
        return config('laravel-redirect.parameter.enabled');
    }

    protected function defaultRoute(): ?string
    {
        return route(config('laravel-redirect.routes.default'));
    }
}
