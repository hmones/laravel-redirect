<h1 align="center">Laravel Redirect</h1>

<p align="center">
<a href="https://github.com/hmones/laravel-redirect/actions"><img src="https://github.com/hmones/laravel-redirect/actions/workflows/build.yml/badge.svg" alt="Build Status"></a>
<a href="https://github.styleci.io/repos/435492427"><img src="https://github.styleci.io/repos/435492427/shield" alt="Style CI"></a>
<a href="https://packagist.org/packages/hmones/laravel-redirect"><img src="http://poser.pugx.org/hmones/laravel-redirect/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/hmones/laravel-redirect"><img src="https://img.shields.io/github/v/release/hmones/laravel-redirect" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/hmones/laravel-redirect"><img src="http://poser.pugx.org/hmones/laravel-redirect/license" alt="License"></a>
</p>

This package is a configurable add-on to your laravel application that allows you to do the following:
- Redirect users back to the protected (needs-authorization) page they wanted to visit right after they log-in instead of the default page.
- Redirect users to a particular destination inside or outside your application by providing that link in a url parameter when logging in or on any of your application pages (e.g. https://your-domain.com/login?redirect=https://another-domain.com).
- Configure the redirect parameter, disable it, make it only accept certain regex or change the name of that parameter
- Configure the middleware group used for authentication in case you are not using laravel defaults or want to use the redirect for another middleware group.

## Installation

Via Composer

```bash
composer require hmones/laravel-redirect
```

## Configuration

To publish the package configuration

```bash
php artisan vendor:publish --tag=laravel-redirect-config
 ```

The configuration file contains the following parameters:
- `web_middleware`: the name of your application's web middleware
    - Env variable: `WEB_MIDDLEWARE`
    - Default value: `web`
- `parameter.enabled` whether you would like to enable parameter redirect on your application, once enabled a user can be redirected for example after login given that their login url was as in this example: `https://mydomain.com/login?redirect=https://another-url.com`
    - Env variable: `REDIRECT_PARAMETER_ENABLED`
    - Default value: `true`
- `parameter.name` if parameter redirect is enabled, you can customize the query parameter used to capture the redirect link
    - Env variable: `REDIRECT_PARAMETER`
    - Default value: `redirect`
- `parameter.regex` if parameter redirect is enabled, you can add a regex to check the redirect query parameter e.g. `/^.*mydomain\.com$/`
    - Env variable: `REDIRECT_REGEX`
    - Default value: `null`
- `routes.login` the name of the login route used by your application
    - Env variable: `LOGIN_ROUTE_NAME`
    - Default value: `login`
- `routes.logout` the name of the logout route used by your application
    - Env variable: `LOGOUT_ROUTE_NAME`
    - Default value: `logout`
- `routes.default` the name of the route that the user is redirected to by default after login
    - Env variable: `DEFAULT_ROUTE_NAME`
    - Default value: `home`

## Usage

- Install the package
- Adjust the configuration parameters in your `.env` file or publish the package configuration file to modify it.
- Add the package service provider at the end of the providers array in your app configuration file `config\app.php`
```php
    'providers' => [
        ...
        Hmones\LaravelRedirect\LaravelRedirectServiceProvider::class
    ],
```

## Change log

Please see the [changelog](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
composer test
```

## Contributing

Please see [contributing.md](CONTRIBUTING.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Haytham Mones][link-author]

## License

Please see the [license file](LICENSE.md) for more information.

[link-author]: https://github.com/hmones
