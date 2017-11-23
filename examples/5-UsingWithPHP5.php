<?php

/**
 * The Config Package supports php5, however there is limitation of php, where we can not use a trait of a reserved name.
 * You will receive a 'colliding constructor definitions' exception.
 *
 * However this is very easily overcome by simply aliasing the trait from __constructor to constructor. See below for an example.
 */


// The configuration class
class Mail extends \Hive\Config\Library
{

    /**
     * Add an alias to the trait so it can be called with in php5
     */
    use \Hive\Config\Mixin\Library
    {
        \Hive\Config\Mixin\Library::__construct as private construct;
    }

    public static $default = [
        'subject'   => 'Wax',
        'from'      => 'wax@hive.com.au',
    ];


    /**
     * Mail constructor.
     *
     * We still actually want the trait to runt he constructor, but as it now has an alias,
     * we have to manually call it.
     *
     * @param string $group the name of the group to use
     * @param array $values and values which to set, this is used for inheriting.
     */
    public function __construct($group = 'default', array $values = [])
    {
        self::construct($group, $values);
    }

}

$config = new Mail('default');

var_dump($config);