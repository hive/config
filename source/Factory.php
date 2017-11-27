<?php namespace Hive\Config;

/**
 * Config Factory.
 *
 * Allows access to a configuration class through a factory.
 *
 * @todo 1.1.0.0 add the ability to use config drivers, return as object||array.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/Config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2016 Jamie  Peake
 */
class Factory implements Contract\Factory
{

    /**
     * Default configuration settings.
     *
     * The the config for the config, or if that is confusing, which options/settings to use with in the class.
     *
     * @var array ['namespaces'] : array : Which namespaces to search for a config, with in our factory
     * @var array ['group'] : string : The name of the config 'group' which to load.
     * @var array ['type'] : boolean|string : The name of the file type to load, defaults to empty. allows for the automatic namespace, ie all configs are with in the Config namespace.
     */
    protected $config = [
        'namespaces'    => [''],        // Check Globally
        'group'         => 'default',   // Great for environmental variables.
        'type'          => false
    ];

    /**
     * @placeholder
     */
    protected $options;

    /**
     * Factory constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        // Set our config with values passed.
        $this->config($config);
    }

    /**
     * Loads a config class and returns its object.
     *
     * @param string $name the name of which config to load.
     *
     * @return \Iterator
     *
     * @throws Exception\ClassDoesNotExist
     */
    public function load($name)
    {
        // Loop through all of our namespaces looking for the config.
        foreach ($this->config['namespaces'] as $namespace)
        {
            // build the class from the namespaces, type and name.
            $class =  $namespace .  '\\' . (($this->config['type']) ?  ($this->config['type'] . '\\' ) : '') . $name;
            if (class_exists($class))
            {
                return new $class($this->config['group']);
            }
        }

        // We didn't find a matching class.
        throw new Exception\ClassDoesNotExist($name);
    }


    /**
     * Allows for the getting and setting of the config.
     *
     * Merge the received config with the existing/defaults and return them.
     *
     * @param array $config any configuration changes required.
     * @return \Array the current internal config.
     */
    public function config(array $config = [])
    {
        // Return our config, after we merge it with any changes.
        return $this->config = array_merge($this->config, $config);
    }

    /**
     * Allow direct access to an item in the config, by using arguments
     *
     * Will load the factory then filter to the result you want.
     *
     * @throws Exception\ArgumentDoesNotExist
     *
     * @param string $name which config class to load
     * @param array $args an array of parameters sent to the magic method, in which to filter the results by.
     * @return \Traversable
     */
    public function __call($name, $args)
    {
        // Assign the values which to filter
        $result = $this->load($name);

        // Filter our results byt the args and return.
        return $this->filter($result, $args);
    }


    /**
     * @param $result
     * @param $args
     *
     * @return mixed
     * @throws Exception\ArgumentDoesNotExist
     */
    public function filter($result, $args = [])
    {
        // Loop through each of the argument each time nesting further in to the config
        foreach ($args as $arg)
        {
            // GIGO : check that the argument exists.
            if (isset($result[$arg]))
            {
                // Assign the result if the argument exists in the config
                $result = $result[$arg];
            }
            else
            {
                // We didn't find a matching argument.
                throw new Exception\ArgumentDoesNotExist($arg);
            }
        }

        // Return our filtered results.
        return $result;
    }
}
