<?php

/**
 * Class MockInherit
 *
 * Simulates a Config Class which inherits.
 *
 */
class MockInherit extends \MockSimple
{
    use \Hive\Config\Mixin\Library
    {
        \Hive\Config\Mixin\Library::__construct as private construct;
    }

    public static $default = [
        'class'     => 'MockInherit',
        'static'    => 'default',
        'inherit'   => 'true'
    ];

    // Call the alias constructor
    public function __construct($group = 'default', array $values = [])
    {
        self::construct($group, $values);
    }

}

