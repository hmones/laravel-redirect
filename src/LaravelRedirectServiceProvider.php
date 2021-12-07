<?php

namespace Hmones\LaravelRedirect;

use Hmones\LaravelRedirect\Http\Middleware\AddRedirectLink;
use Hmones\LaravelRedirect\Http\Middleware\AddRedirectPage;
use Hmones\LaravelRedirect\Http\Middleware\AddRedirectParameter;
use Hmones\LaravelRedirect\Http\Middleware\RedirectToPage;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class LaravelRedirectServiceProvider extends ServiceProvider
{
    public function boot(Kernel $kernel): void
    {
        $kernel->pushMiddleware(AddRedirectParameter::class);
        $kernel->appendMiddlewareToGroup(config('laravel-redirect.web_middleware'), AddRedirectPage::class);
        $kernel->appendMiddlewareToGroup(config('laravel-redirect.web_middleware'), RedirectToPage::class);

        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-redirect.php', 'laravel-redirect');
    }

    public function provides(): array
    {
        return ['laravel-redirect'];
    }

    protected function bootForConsole(): void
    {
        $this->publishes([
            __DIR__.'/../config/laravel-redirect.php' => config_path('laravel-redirect.php'),
        ], 'laravel-redirect.config');
    }
}
