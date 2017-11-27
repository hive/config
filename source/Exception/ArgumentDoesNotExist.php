<?php namespace Hive\Config\Exception;

/**
 * Argument does not Exist Exception.
 *
 * Called when the package loads a class and is attempting to return a specific result which does not exist.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2017 Jamie Peake
 */
class ArgumentDoesNotExist extends \Hive\Config\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 2;

    /**
     * Exception Message to be displayed.
     */
    const MESSAGE = 'The argument (:name) does not exist, please ensure that it is defined with in the  config file.';

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
