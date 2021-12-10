<?php

namespace Hmones\LaravelFacade\Tests\Feature;

use Hmones\LaravelRedirect\Tests\TestCase;
use Illuminate\Support\Facades\Cookie;

class ParameterRedirectTest extends TestCase
{
    protected const TEST_URL = 'https://www.test.com';

    public function test_parameter_is_stored_in_cookies_when_present_and_valid(): void
    {
        Cookie::spy();
        $this->get(route('login', ['redirect' => self::TEST_URL]));
        Cookie::shouldReceive('queue', self::TEST_URL);
    }

    public function test_parameter_is_not_stored_in_cookies_when_invalid_url_provided(): void
    {
        Cookie::spy();
        $this->get(route('login', ['redirect' => 'invalid url']));
        Cookie::shouldNotReceive('queue', 'invalid url');
    }

    public function test_parameter_is_not_stored_in_cookies_when_invalid_url_provided_and_regex_configured(): void
    {
        $this->app['config']->set('laravel-redirect.parameter.regex', '/^domain\.test$/');
        Cookie::spy();
        $this->get(route('login', ['redirect' => self::TEST_URL]));
        Cookie::shouldNotReceive('queue', self::TEST_URL);
    }

    public function test_user_is_redirected_to_parameter_value_after_login(): void
    {
        $this->followRedirects = false;
        $this->actingAs(auth()->loginUsingId($this->user->id))
            ->withCookie('previousUrl', self::TEST_URL)
            ->get(route('home'))
            ->assertRedirect(self::TEST_URL);
    }
}
