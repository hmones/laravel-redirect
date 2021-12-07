<?php

namespace Hmones\LaravelRedirect\Tests;

use Hmones\LaravelRedirect\LaravelRedirectServiceProvider;
use Orchestra\Testbench\TestCase as Test;

class TestCase extends Test
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelRedirectServiceProvider::class,
        ];
    }
}
