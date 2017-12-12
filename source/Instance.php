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
        'type'          => false,
    ];

    /**
     * Initialise the instance.
     *
     * Will create the object if it does not exist.
     *
     * @param string $name
     * @return \Iterator
     */
    public static function load($name)
    {
        // Does the object already exist
        if (isset(self::$objects[$name][self::$config['group']]))
        {
            return self::$objects[$name][self::$config['group']];
        }
        else
        {
            // Create the factory every time.
            $factory = new Factory(self::$config);

            // Both load and return the config
            return self::$objects[$name][self::$config['group']] = $factory->load($name);
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
        // Return our config, after we merge it with any changes.
        return self::$config = array_merge(self::$config, $config);
    }


    /**
     * Allow direct access to an item in the config, by using arguments
     *
     * @throws Exception\ArgumentDoesNotExist
     *
     * @param       $name
     * @param array|bool $args
     * @return \Iterator
     */
    public static function __callStatic($name, $args = false)
    {
        // Get the full result
        $result =  self::load($name);

        // Load up the factory, with no config
        $factory = new Factory();

        // Filter and return our results
        return $factory->filter($result, $args);
    }

    /**
     * Allows the destruction of the instance.
     *
     * This is used for Unit testing the instance.
     */
    public static function destroy()
    {
        // Destroy our objects
        self::$objects = null;
    }
}
