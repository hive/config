<?php

/**
 * Class MockException
 */
class MockNested extends \Hive\Config\Library
{
    use \Hive\Config\Mixin\Library
    {
        \Hive\Config\Mixin\Library::__construct as private construct;
    }

    public static $default = [
        'class'     => 'MockNested',
        'static'    => 'default',
        'simple'    => 'false',
        'nest'      => [
            'name'  => 'MockNested',
            'detail' => [
                'type'      => 'nested',
                'parent'    => 'none',
                'ignore'    => 'true',
                'override'  => 'false'
            ]
        ]
    ];

    // Call the alias constructor
    public function __construct($group = 'default', array $values = [])
    {
        self::construct($group, $values);
    }

}

