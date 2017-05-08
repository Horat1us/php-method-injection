<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 5/8/17
 * Time: 4:43 PM
 */

namespace Horat1us\MethodInjection;


/**
 * Class InjectMethods
 * @package Horat1us\MethodInjection
 */
trait InjectMethods
{
    /**
     * @var \Closure[]
     */
    protected $injectedMethods;

    /**
     * InjectMethods constructor.
     *
     * @param \Closure[] $injectedMethods
     */
    public function __construct(array $injectedMethods = [])
    {
        foreach ($injectedMethods as $key => $injectedMethod) {
            $this->injectMethod($key, $injectedMethod);
        }
    }

    /**
     * Inject method
     *
     * @param string $name
     * @param \Closure $closure
     * @return $this
     */
    public function injectMethod(string $name, \Closure $closure)
    {
        $injected = clone $closure;

        $injected->bindTo($this);
        $this->injectedMethods[$name] = $injected;

        return $this;
    }

    /**
     * Removing injected method
     *
     * @param string $name
     * @return $this
     */
    public function removeMethod(string $name)
    {
        unset($this->injectedMethods[$name]);

        return $this;
    }

    /**
     * Calling injected method
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws MethodNotFoundException
     */
    public function __call($name, $arguments)
    {
        $method = $this->injectedMethods[$name] ?? null;
        if(!$method instanceof \Closure) {
            throw new MethodNotFoundException($this, $name, $arguments);
        }
        return call_user_func($method, ...$arguments);
    }

    /**
     * JS-style settings methods
     *
     * @param $name
     * @param $value
     * @return bool
     */
    public function __set($name, $value)
    {
        if($value instanceof \Closure) {
            $this->injectMethod($name, $value);
            return true;
        }

        $this->{$name} = $value;
        return false;
    }

    /**
     * @param $name
     * @return \Closure|mixed
     */
    public function __get($name)
    {
        if(array_key_exists($name, $this->injectedMethods)) {
            return $this->injectedMethods[$name];
        }

        return $this->{$name};
    }
}