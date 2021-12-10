<?php

namespace Hmones\LaravelFacade\Tests\Feature;

use Hmones\LaravelRedirect\Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;

class PageRedirectTest extends TestCase
{
    public function test_authenticated_page_is_saved_in_cookie_then_user_redirected_to_login(): void
    {
        Cookie::spy();
        $this->get(route('protected'));
        Cookie::shouldReceive('queue', route('protected'));
    }

    public function test_after_successful_login_user_is_redirected_to_protected_page(): void
    {
        $this->withCookie('previousUrl', route('protected'))
            ->post('login', Arr::only($this->userData, ['email', 'password']))
            ->assertSee('protected');
    }
}
