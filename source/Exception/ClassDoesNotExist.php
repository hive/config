<?php namespace Hive\Config\Exception;

/**
 * Class does not Exist Exception.
 *
 * Called when the factory attempts to load a class which does not exist, ie. it was unable to find the config class by that name.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2017 Jamie Peake
 */
class ClassDoesNotExist extends \Hive\Config\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 1;

    /**
     * Exception Message to be displayed.
     */
    const MESSAGE = 'The config class (:name) does not exist, please ensure that the config file exists and the namespace is defined.';

    /**
     * Class does not exist Constructor, assigns exception code and places the message.
     *
     * Will also place the name of the class into the exception message if we have it
     *
     * @param string $name name of the class which we could not find.
     */
    public function __construct($name)
    {
        $code = self::CODE;
        $message = strtr(self::MESSAGE, [':name' => $name]);

        parent::__construct($message, $code);
    }
}
