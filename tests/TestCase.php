<?php

namespace Hmones\LaravelRedirect\Tests;

use Hmones\LaravelRedirect\LaravelRedirectServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Orchestra\Testbench\TestCase as Test;

class TestCase extends Test
{
    use InteractsWithViews;
    use RefreshDatabase;

    protected $user;
    protected $userData = [
        'email'    => 'test@test.test',
        'name'     => 'user',
        'password' => 'password'
    ];

    protected function getPackageProviders($app): array
    {
        return [
            LaravelRedirectServiceProvider::class,
        ];
    }

    protected function defineWebRoutes($router)
    {
        $router->get('guest-route', function () {
            return response('guest.page');
        })->name('guest.index');

        $router->get('login', function () {
            return response('login');
        })->name('login');

        $router->post('login', function (Request $request) {
            if ($request->email === $this->userData['email'] && $request->password === $this->userData['password']) {
                auth()->loginUsingId(DB::table('users')->first()->id);

                return redirect(route('home'));
            }

            return redirect(route('login'));
        });

        $router->get('/', function () {
            return response('home');
        })->name('home')->middleware('auth');

        $router->get('protected', function () {
            if (auth()->guest()) {
                return redirect(route('login'));
            }
            return response('protected');
        })->name('protected');

        $router->post('logout', function () {
            auth()->logout();

            return redirect(route('login'));
        })->name('logout')->middleware('auth');
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
    }

    protected function setUp(): void
    {
        parent::setUp();
        DB::table('users')->insert(array_merge($this->userData, ['password' => Hash::make($this->userData['password'])]));
        $this->user = DB::table('users')->first();
    }
}
