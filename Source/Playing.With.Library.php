<?php namespace Hive\Config;

/**
 * Config Library.
 *
 * The actual Config library, which does the core operations.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/Config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2016 Jamie Peake
 */
class Library implements Contract\Library
{
    private $object;

    /**
     * @var string The name of the config to load
     */
    private $name;

    /**
     * @var array an array of namespaces to search
     */
    private $namespaces = [];

    /**
     * @var string the environment
     */
    private $environment;


    private $default;

    public function __construct($name, $environment, $namespaces, $default) {

        $this->name = $name;
        $this->default= $default;
        $this->environment = $environment;
        $this->namespaces = $namespaces;

    }

    public function parse() {

        foreach ($this->namespaces as $namespace) {

            $class = $namespace . $this->name;

            if (class_exists($class)) {
                return  new $class($this->environment);
            }
        }

    }
}
