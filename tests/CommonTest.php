<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 5/8/17
 * Time: 5:23 PM
 */

namespace Horat1us\MethodInjection\Tests;


use Horat1us\MethodInjection\DynamicObject;

class CommonTest extends \PHPUnit_Framework_TestCase
{

    public function testAddingMethod()
    {
        $object = new DynamicObject();
        $expected = mt_rand();
        $method = function () use ($expected) {
            return $expected;
        };
        $object->injectMethod('test', $method);
        $res = $object->{'test'}();
        $this->assertEquals($expected, $res);

        $object->{'js'} = $method;
        $res = $object->{'js'}();
        $this->assertEquals($expected, $res);
    }

    public function testConstruct()
    {
        $object = new DynamicObject([
            'true' => function () {
                return true;
            },
            'false' => function () {
                return false;
            }
        ]);
        $this->assertTrue($object->{'true'}());
        $this->assertFalse($object->{'false'}());
    }

    public function testSetter()
    {
        $object = new DynamicObject();
        $this->assertTrue($object->__set('test', function() {
        }));
        $this->assertInstanceOf(\Closure::class, $object->{'test'});
        $this->assertFalse($object->__set('test', 2));
        $this->assertEquals(2, $object->{'test'});
    }
}