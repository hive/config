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
     * Mixin constructor.
     *
     * @param       $environment
     * @param array $array
     */
    public function __construct(string $environment, array $values = []) {

        if (isset(self::$$environment)) {
            $values = array_merge(self::$$environment, $values);
        }

        if (isset(self::$default)) {
            $values = array_merge(self::$default, $values);
        }

        parent::__construct($environment, $values);

    }
}
