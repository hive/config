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
     * Load a config class
     *
     * @param string $name the config to get.
     *
     * @return array
     */
    public function load($name);


    /**
     * Get/Set the internal configuration.
     *
     * @param array $config any configuration changes required.
     *
     * @return \Array the current internal config.
     */
    public function config(array $config = []);
}
