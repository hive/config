<?php namespace Hive\Config\Exception;

/**
 * Instance Does not Exist Exception.
 *
 * Called when the instance called does not exist, ie. it was unable to find the config class by that name.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2017 Jamie Peake
 */
class InstanceDoesNotExist extends \Hive\Config\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 2;

    /**
     * Exception Message to be displayed.
     */
    const MESSAGE = 'The config instance (:name) does not exist, please ensure that the config file exists and the namespace is defined.';

    /**
     * Instance does not exist Constructor, assigns exception code and places the message.
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
