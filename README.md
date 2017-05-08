# PHP Method Injection Trait
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Horat1us/php-method-injection/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Horat1us/php-method-injection/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Horat1us/php-method-injection/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Horat1us/php-method-injection/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Horat1us/php-method-injection/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Horat1us/php-method-injection/build-status/master)


This trait allows you to extend your object with custom method dynamically.

## Usage
You can use **DynamicObject** 
or implement interface **InjectMethodsInterface** with trait **InjectMethods** on your custom object. 

[Simple example](./examples/simple-object.php) will output:
```
Hello, Alexander
Hello, Letnikow
Array
(
    [arguments] => Array
        (
            [0] => Man
        )

    [methodName] => welcome
    [object] => Horat1us\MethodInjection\DynamicObject
    [message] => Bound Method welcome not found in Horat1us\MethodInjection\DynamicObject
)

```

## About

This package is created for using in tests.
For example, you have interface
```php
<?php
interface ServiceInterface
{
    public function run($args);
}
```
and you need to test arguments which will be passed to this service.
You can define fake service:
```php
<?php
use Horat1us\MethodInjection\InjectMethodsInterface;
use Horat1us\MethodInjection\InjectMethods;

/**
 * @method Test($args) 
 */
class FakeService implements InjectMethodsInterface, ServiceInterface
{
    use InjectMethods;
    
    public function run($args) {
        $this->Test($args);
    }
}
```
and use it in your test service
```php
<?php
$service = new FakeService(['Test' => function() {
    // Your tests here
}]);
ServiceRunner::run($service);
```

## Install
```bash
composer require horat1us/php-method-injection
```

## Tests
```bash
phpunit
```


### License

This project is open-sourced software licensed under the [MIT license](./LICENSE)

