<?php namespace Hive\Config\Contract;

/**
 * Factory Interface.
 *
 * Offers factory access to config objects
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2017 Jamie Peake
 *
 */
interface Factory extends Library
{
    /**
     * Load a config
     *
     * @param string $name the config to get.
     *
     * @return array
     */
    public function load($name);
}
