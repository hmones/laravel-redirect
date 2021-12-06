<?php

namespace Hmones\LaravelRedirect;

use Hmones\LaravelRedirect\Http\Middleware\AddRedirectLink;
use Hmones\LaravelRedirect\Http\Middleware\RedirectToLink;
use Hmones\LaravelRedirect\Http\Middleware\RedirectToPage;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class LaravelRedirectServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->make(Router::class)
            ->prependMiddlewareToGroup('web', AddRedirectLink::class)
            ->pushMiddlewareToGroup('web', RedirectToPage::class);

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
