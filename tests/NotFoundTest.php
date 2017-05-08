<?php

namespace Horat1us\MethodInjection\Tests;

use Horat1us\MethodInjection\DynamicObject;
use Horat1us\MethodInjection\MethodNotFoundException;

class NotFoundTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $object = new DynamicObject();
        $params = range(0, 100);
        shuffle($params);
        try {
            call_user_func([$object, 'undefinedMethod'], ...$params);
        } catch (MethodNotFoundException $ex) {
            $this->assertEquals($params, $ex->getArguments());
            $this->assertEquals($object, $ex->getObject());
            $this->assertEquals('undefinedMethod', $ex->getName());
        }
    }

    public function testAfterRemove()
    {
        $object = new DynamicObject();
        $object->{'method'} = function() {
            return true;
        };
        $this->assertTrue(call_user_func([$object, 'method']));
        $object->removeMethod('method');
        $this->expectException(MethodNotFoundException::class);
        $object->{'method'}();
    }
}

