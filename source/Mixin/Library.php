<?php namespace Hive\Config\Mixin;

/**
 * Constructor Trait.
 *
 * The trait to use with in an configuration file to ensure correct implementation.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/Config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2016 Jamie Peake
 */
trait Library
{
    /**
     * Library constructor.
     *
     * @param       $group
     * @param array $values
     */
    public function __construct($group = 'default', array $values = [])
    {
        if (isset(self::$$group))
        {
            $values = array_replace_recursive(self::$$group, $values);
        }

        if (isset(self::$default))
        {
            $values = array_replace_recursive(self::$default, $values);
        }

        parent::__construct($environment, $values);

    }
}
