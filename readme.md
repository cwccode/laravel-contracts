:warning: **This package has been abandonned.**

I can't promise it will get baked into [Laravel](https://github.com/laravel/framework), but it has popped up on [Taylor Otwell's radar](https://twitter.com/taylorotwell/status/1440364082037592068), so it could happen 🤞

# Laravel Contract Command

`cwccode/laravel-contracts` is a package that adds a `make:contract` command to Laravel, to create interfaces for your application.

## Installation

You can install the package using composer:

```bash
composer require --dev cwccode/laravel-contracts
```

For Laravel 5.4 or less, you'll need to register the service provider manually in /config/app.php

## Usage

To make a new interface, simply run:

```bash
php artisan make:contract InterfaceName
```

This will produce the following file in `app/Contracts/InterfaceName.php`:

```php
<?php

namespace App\Contracts;

interface InterfaceName
{
    //
}
``` 

You can also specify some methods by passing one or more `--method` options:

```bash
php artisan make:contract InterfaceName --method=method1 --method=method2
```

This will produce:

```php
<?php

namespace App\Contracts;

interface InterfaceName
{
    /**
     * method1
     *
     * @return void
     */
    public function method1();

    /**
     * method2
     *
     * @return void
     */
    public function method2();
}
``` 
