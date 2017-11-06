<?php namespace Config;

/**
 * Class MockException
 *
 * Simulates a config class with in a namespace.
 */
class MockNamespace extends \Hive\Config\Library
{
    use \Hive\Config\Mixin\Library
    {
        \Hive\Config\Mixin\Library::__construct as private construct;
    }

    public static $default = [
        'class'   => 'MockSimple',
        'static'    => 'default',
        'simple'    => 'true',
        'namespace'    => 'Config',
    ];

    // Call the alias constructor
    public function __construct($group = 'default', array $values = [])
    {
        self::construct($group, $values);
    }

}

