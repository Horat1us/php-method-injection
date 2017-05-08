<?php

require_once './vendor/autoload.php';

use Horat1us\MethodInjection\DynamicObject;
use Horat1us\MethodInjection\MethodNotFoundException;

/**
 * @property string $a
 */
$object = new DynamicObject(); // Or another object that implements InjectMethodsInterface or use InjectMethods trait

$newMethod = function(string $name) {
    echo "Hello, {$name}\n";
};

$object->injectMethod('welcome', $newMethod);

$object->welcome("Alexander");
call_user_func([$object, 'welcome'],'Letnikow');

$object->removeMethod('welcome');

try {
    $object->welcome("Man");
}
catch(MethodNotFoundException $ex) {
    $exception = [
        'arguments' => $ex->getArguments(),
        'methodName' => $ex->getName(),
        'object' => get_class($ex->getObject()),
        'message' => $ex->getMessage(),
    ];
    print_r($exception);
}