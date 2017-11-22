<?php namespace Hive\Config\Contract;

/**
 * Instance Interface.
 *
 * Interface for use with the instances.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/Config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2016 Jamie Peake
 */
interface Instance
{

    /**
     * Load a config class
     *
     * @param string $name the config to get.
     *
     * @return array
     */
    public static function load($name);

    /**
     * Get/Set the internal configuration.
     *
     * @param array $config any configuration changes required.
     *
     * @return \Array the current internal config.
     */
    public static function config(array $config = []);
}
