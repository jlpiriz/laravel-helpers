# Helpers for Laravel 5

Simple package with useful things for Laravel 5.5 or highest.

[![Latest Stable Version](https://poser.pugx.org/jlpiriz/laravel-helpers/v/stable?format=flat-square)](https://packagist.org/packages/jlpiriz/laravel-helpers)
[![License](https://poser.pugx.org/jlpiriz/laravel-helpers/license?format=flat-square)](https://packagist.org/packages/jlpiriz/laravel-helpers)

## Installation

To install this package you will need:

* Laravel 5.5+
* PHP 7.1+

Install via composer to require the package.

```bash
$ composer require barryvdh/laravel-debugbar --dev
```
    
Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
Jlpiriz\LaravelHelpers\Providers\HelpersServiceProvider::class,
```

Finally, you will want to publish the config using the following command:

```bash
$ php artisan vendor:publish --provider="Jlpiriz\LaravelHelpers\Providers\HelpersServiceProvider"
```

## Usage

> This package is starting. You will soon have more features.

All classes use the singleton pattern. This ensure that only one instance of a class is created. The global point of access to the object is the method getInstance().

#### Logger

Logger class save any variable to a file. The variables can take are: array, bool, float, int, null, object and string. Any other variables give a file with an error message.

```php
	$log = Logger::getInstance("/my/relative/path")
	$log->save("file.txt", "hello world....");

        or 
        
	Logger::getInstance()->save("file.txt", ["hello", 12.5, [1,2,"world",4,5] ]);
```

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Make your changes
4. Commit your changes (`git commit -am 'Added some feature'`)
5. Push to the branch (`git push origin my-new-feature`)
6. Create new Pull Request

## License

Helpers for Laravel 5 is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
