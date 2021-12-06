<h1 align="center">Laravel Redirect</h1>

<p align="center">
<a href="https://github.com/hmones/laravel-redirect/actions"><img src="https://github.com/hmones/laravel-redirect/actions/workflows/build.yml/badge.svg" alt="Build Status"></a>
<a href="https://github.styleci.io/repos/390311402"><img src="https://github.styleci.io/repos/390311402/shield" alt="Style CI"></a>
<a href="https://packagist.org/packages/hmones/laravel-redirect"><img src="http://poser.pugx.org/hmones/laravel-redirect/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/hmones/laravel-redirect"><img src="https://img.shields.io/github/v/release/hmones/laravel-redirect" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/hmones/laravel-redirect"><img src="http://poser.pugx.org/hmones/laravel-redirect/license" alt="License"></a>
</p>

This package helps users get redirected automatically after their login attempt to the previous protected route they were trying to access:

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

The configuration contains the following values:

```php
    'login' => [
        'route' => env('LOGIN_ROUTE_NAME', 'login')
    ],
    'parameter' => env('REDIRECT_PARAMETER', 'redirect')
```

- The **route** attribute represents the name of the route that normally users use to login to the application.
- The **parameter** attribute represents the name of the redirect attribute that will be added to the login url in case of unauthenticated user access.

## Usage

- Install the package
- Add the configuration parameter to your `.env` file or publish the package configuration to modify it.

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

license. Please see the [license file](LICENSE.md) for more information.

[link-author]: https://github.com/hmones
