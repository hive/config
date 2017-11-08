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
class Instance implements Contract\Instance
{

    /**
     * @var
     */
    private static $objects;

    /**
     * @var
     */
    protected static $options;

    /**
     * @var array
     */
    public static $namespaces = [
        '',         // Check Globally
    ];

    /**
     * The name of the file type to load, defaults to empty.
     * allows for the automatic namespace, ie all configs are with in the Config namespace.
     * @var string
     */
    public static $type = false;

    /**
     * @todo rename to 'group', for a more generic use of it.
     * @var string
     */
    public static $environment = 'default';


    /**
     * Initialise the instance.
     *
     * Will create the object if it does not exist.
     *
     * @param $name
     * @throws Exception\InstanceDoesNotExist
     * @return bool
     */
    private static function init($name)
    {
        // Does the object already exist
        if (isset(self::$objects[$name]))
        {
            return true;
        }
        else
        {
            // Loop through all of our namespaces looking for the config.
            foreach (self::$namespaces as $namespace)
            {
                // build the class from the namespaces, type and name.
                $class =  $namespace .  '\\' . ((self::$type) ?  (self::$type . '\\' ) : '') . $name;

                if (class_exists($class))
                {
                    self::$objects[$name] = new $class(self::$environment);
                    return true;
                }
            }
        }

        // We didn't find a matching class.
        throw new Exception\InstanceDoesNotExist($name);
    }


    /**
     * Allow direct access to an item in the config, by using arguments
     * cal
     * @param       $name
     * @param array $args
     * @return array
     */
    public static function __callStatic($name, $args)
    {

        $result = false;

        if (self::init($name))
        {
            $result = iterator_to_array(self::$objects[$name]);

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
