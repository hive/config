<?php

/**
 * The Config Package supports php5, however there is limitation of php, where we can not use a trait of a reserved name.
 * You will receive a 'colliding constructor definitions' exception.
 *
 * However this is very easily overcome by simply aliasing the trait from __constructor to constructor. See below for an example.
 */


// The configuration class
class Mail extends \Hive\Config\Library
{

    /**
     * Add an alias to the trait so it can be called with in php5
     */
    use \Hive\Config\Mixin\Library
    {
        \Hive\Config\Mixin\Library::__construct as private construct;
    }

    public static $default = [
        'send' => 'Yes',
        'message' => 'This is the mail message',
        'details' =>  [
            'subject'   => 'This is the mail subject',
            'from'      => 'Hive Config',
        ],
    ];


    /**
     * Mail constructor.
     *
     * We still actually want the trait to runt he constructor, but as it now has an alias,
     * we have to manually call it.
     *
     * @param string $group the name of the group to use
     * @param array $values and values which to set, this is used for inheriting.
     */
    public function __construct($group = 'default', array $values = [])
    {
        self::construct($group, $values);
    }

}


/**
 * Example  2
 *
 * This shows, using the factory in its most simplest form, which is not very different calling the class.
 */

// Create a factory
$factory = new Config\Factory();

// Load and return our mail
$mail = $factory->load('Mail');

// Echo the results
echo $mail['send'];                 // 'Yes'
echo $mail['message'];              // 'This is the mail message'
echo $mail['details']['subject'];   // 'This is the mail subject'

/**
 * Example 3
 *
 * We can also directly call the factory and the filter the results
 */

// Added for example context
$factory = new Config\Factory();

// Echo the results
echo $factory->mail('send');                // 'Yes'
echo $factory->mail('message');             // 'This is the mail message'
echo $factory->mail('details', 'subject');  // 'This is the mail subject'

/**
 * Example 4
 *
 * All of the above can also be accomplished from an instance.
 */

// Echo the results
echo Config\Instance::Mail('send');                 // 'Yes'
echo Config\Instance::Mail('message');              // 'This is the mail message'
echo Config\Instance::Mail('details', 'subject');   // 'This is the mail subject'

/**
 * Example 5.
 *
 * As you can see, once you have created the config, with a trait and constructor
 * everything else will be the same as the other examples you see. This goes for both
 * cascading and grouping as well.
 */

class Email extends \Mail
{
    /**
     * We still need the trait if we are extending with php5.
     */
    use \Hive\Config\Mixin\Library
    {
        \Hive\Config\Mixin\Library::__construct as private construct;
    }

    public static $production = [
        'message'   => 'This is the production email message.'
    ];


    /**
     * Email constructor.
     *
     * We still need the constructor if we are extending with php5.
     *
     * @param string $group
     * @param array  $values
     */
    public function __construct($group = 'default', array $values = [])
    {
        self::construct($group, $values);
    }

}

$factory = new Config\Factory(['group' => 'production']);

echo $factory->email('message');            // 'This is the production email message.'
echo $factory->email('details', 'subject'); // 'This is the mail subject'
