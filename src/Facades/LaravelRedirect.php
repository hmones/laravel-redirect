<?php

namespace Hmones\LaravelRedirect\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelRedirect extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-redirect';
    }
}
