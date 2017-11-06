<?php namespace Shared\Config;

/**
 * Class MockException
 *
 * Simulates a namespace with in a deeper namespace, with the same name of another config.
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
        'namespace'    => 'Shared\Config',
    ];

    // Call the alias constructor
    public function __construct($group = 'default', array $values = [])
    {
        self::construct($group, $values);
    }

}

