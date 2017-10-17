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
    public  static $namespaces = [
        'Shared'
    ];

    /**
     * The name of the file type to load, defaults to config.
     * @var string
     */
    public static $type = 'Config';

    /**
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

        if (isset(self::$objects[$name]))
        {
            return true;

        }
        else
        {
            foreach (self::$namespaces as $namespace)
            {
                $class = '\\'  . $namespace . '\\' . self::$type . '\\' . $name;

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

        if (self::init($name))
        {
            $result = iterator_to_array(self::$objects[$name]);

            foreach ($args as $arg)
            {
                $result = $result[$arg];
            }

            return $result;
        }
    }

}
