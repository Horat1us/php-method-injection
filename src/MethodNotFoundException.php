<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 5/8/17
 * Time: 4:46 PM
 */

namespace Horat1us\MethodInjection;


use Throwable;

/**
 * Class MethodNotFoundException
 * @package Horat1us\MethodInjection
 */
class MethodNotFoundException extends \Exception
{
    /**
     * List of arguments, which was used to call method
     *
     * @var array
     */
    protected $arguments;

    /**
     * Injected method name
     *
     * @var string
     */
    protected $name;

    /**
     * Object with not-found injected method
     *
     * @var object
     */
    protected $object;

    /**
     * MethodNotFoundException constructor.
     * @param $object
     * @param string $name
     * @param array $arguments
     */
    public function __construct($object, string $name, array $arguments = [])
    {
        $this->name = $name;
        $this->object = $object;
        $this->arguments = $arguments;
        parent::__construct($this->generateMessage());
    }

    /**
     * @return string
     */
    protected function generateMessage()
    {
        return "Bound Method {$this->name} not found in " . get_class($this->object);
    }

    /**
     * @return object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}