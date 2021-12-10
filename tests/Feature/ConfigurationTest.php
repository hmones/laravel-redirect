<?php

namespace Hmones\LaravelFacade\Tests\Feature;

use Hmones\LaravelRedirect\Tests\TestCase;
use Illuminate\Support\Facades\Cookie;

class ConfigurationTest extends TestCase
{
    protected const TEST_URL = 'https://www.test.com';

    public function test_redirect_parameter_is_not_saved_in_cookies_if_it_is_disabled(): void
    {
        $this->app['config']->set('laravel-redirect.parameter.enabled', false);
        Cookie::spy();
        $this->get(route('login', ['redirect' => self::TEST_URL]));
        Cookie::shouldNotReceive('queue', self::TEST_URL);
    }

    public function test_redirect_parameter_is_saved_if_regex_configured_and_url_matches(): void
    {
        $this->app['config']->set('laravel-redirect.parameter.regex', '/^domain\.test$/');
        Cookie::spy();
        $this->get(route('login', ['redirect' => 'https://www.domain.test/?test']));
        Cookie::shouldReceive('queue', 'https://www.domain.test/?test');
    }

    public function test_redirect_parameter_is_not_saved_if_changed_parameter_name_in_config(): void
    {
        $this->app['config']->set('laravel-redirect.parameter.name', 'url');
        Cookie::spy();
        $this->get(route('login', ['redirect' => self::TEST_URL]));
        Cookie::shouldNotReceive('queue', self::TEST_URL);
    }

    public function test_redirect_parameter_is_saved_when_changed_parameter_name_in_config(): void
    {
        $this->app['config']->set('laravel-redirect.parameter.name', 'url');
        Cookie::spy();
        $this->get(route('login', ['url' => self::TEST_URL]));
        Cookie::shouldReceive('queue', self::TEST_URL);
    }
}
