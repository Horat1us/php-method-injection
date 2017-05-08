<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 5/8/17
 * Time: 5:04 PM
 */

namespace Horat1us\MethodInjection;


/**
 * Interface InjectMethodsInterface
 * @package Horat1us\MethodInjection
 */
interface InjectMethodsInterface
{
    /**
     * Inject method
     *
     * @param string $name
     * @param \Closure $closure
     * @return $this
     */
    public function injectMethod(string $name, \Closure $closure);

    /**
     * Removing injected method
     *
     * @param string $name
     * @return $this
     */
    public function removeMethod(string $name);
}