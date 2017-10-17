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
     * @param       $environment
     * @param array $values
     */
    public function __construct($environment, array $values = [])
    {
        if (isset(self::$$environment))
        {
            $values = array_replace_recursive(self::$$environment, $values);
        }

        if (isset(self::$default))
        {

            $values = array_replace_recursive(self::$default, $values);
        }


        parent::__construct($environment, $values);

    }

}
