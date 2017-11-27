<?php namespace Hive\Config;

/**
 * Config Instance.
 *
 * Allows access to the config object through a instance.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/Config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2016 Jamie  Peake
 */
abstract class Instance implements Contract\Instance
{

    /**
     * Holds our static config objects.
     * @var array
     */
    private static $objects;

    /**
     * Default configuration settings.
     *
     * The the config for the config, or if that is confusing, which options/settings to use with in the class.
     *
     * @var array ['namespaces'] : array : Which namespaces to search for a config, with in our factory
     * @var array ['group'] : string : The name of the config 'group' which to load.
     * @var array ['type'] : boolean|string : The name of the file type to load, defaults to empty. allows for the automatic namespace, ie all configs are with in the Config namespace.
     */
    protected static $config = [
        'namespaces'    => [''],        // Check Globally
        'group'         => 'default',   // Great for environmental variables.
        'type'          => false
    ];

    /**
     * Initialise the instance.
     *
     * Will create the object if it does not exist.
     *
     * @param $name
     * @return \Iterator
     */
    public static function load($name)
    {
        // Does the object already exist
        if (isset(self::$objects[$name]))
        {
            return self::$objects[$name];
        }
        else
        {
            // Create the factory every time.
            $factory = new Factory(self::$config);

            // Load the config and assign it to our static objects.
            return self::$objects[$name] = $factory->load($name);
        }
    }

    /**
     * Allows for the getting and setting of the config.
     *
     * Merge the received config with the existing/defaults and return them.
     *
     * @param $config
     * @return \Array the current internal config.
     */
    public static function config(array $config = [])
    {
        return self::$config = array_merge(self::$config, $config);
    }


    /**
     * Allow direct access to an item in the config, by using arguments
     * @param       $name
     * @param array $args
     * @return array
     */
    public static function __callStatic($name, $args)
    {
        $result = false;

        if (self::load($name))
        {
            $result = self::$objects[$name];  // JP: iterator_to_array removed
            foreach ($args as $arg)
            {
                $result = $result[$arg];
            }
        }

        return $result;
    }

    /**
     * Allows the destruction of the instance.
     *
     * This is used for Unit testing the instance.
     */
    public static function destroy()
    {
        self::$objects = null;
    }
}
