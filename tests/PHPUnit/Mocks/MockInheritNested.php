<?php

/**
 * Class MockException
 */
class MockInheritNested extends \MockNested
{
    use \Hive\Config\Mixin\Library
    {
        \Hive\Config\Mixin\Library::__construct as private construct;
    }

    public static $default = [
        'class'     => 'MockInheritNested',
        'simple'    => 'false',
        'nest'      => [
            'name'  => 'MockInheritNested',
            'detail' => [
                'type'      => 'nested',
                'parent'    => 'MockNested',
                'override'  => 'true'
            ]
        ]
    ];

    // Call the alias constructor
    public function __construct($group = 'default', array $values = [])
    {
        self::construct($group, self::$default);
    }

}

