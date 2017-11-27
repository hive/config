<?php

/**
 * Groups allow us to 'group' options of a config together, and retrieve them together.
 * So far in in the first set of examples, we were using the 'default' group.
 *
 * However in the examples below, we will be adding two more groups, one for when we
 * are in development and the other for when we are in production. As we don't want to send
 * mail from production.
 *
 * Groups are either defined, when you construct the object, or through the packages config method.
 * Each group will always inherit from the default, so if you don't have any default setting, don't include 'default'.
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the config
use Hive\Config;

// The configuration class.
class Mail extends Config\Library
{

    public static $default = [
        'send' => 'No',
        'message' => 'This is the default mail message',
        'details' =>  [
            'subject'   => 'This is the default mail subject',
            'from'      => 'Hive Config Default',
        ]
    ];


    public static $production = [
        'send'          => 'Yes',
        'message'       => 'This is the production mail message.'
    ];

    public static $development = [
        'details' =>  [
            'subject'   => 'This is the development mail subject',
            'from'      => 'Hive Config Development',
        ]
    ];
}


/**
 * Example 1
 *
 * Create a development mail config, in its simplest form.
 */

// Create a development object
$mail = new Mail('development');

// Echo the results
echo $mail['send'];                 // 'No'
echo $mail['message'];              // 'This is the default mail message'
echo $mail['details']['subject'];   // 'This is the development mail subject'

/**
 * Example 2
 *
 * Create a production mail config, in its simplest form.
 */
// Create a production object
$mail = new Mail('production');

// Echo the results
echo $mail['send'];               // 'Yes'
echo $mail['message'];            // 'This is the production mail message.'
echo $mail['details']['subject']; // 'This is the default mail subject'

/**
 * Example 3.
 *
 * This is the creation of a factory and setting it to the development group.
 * All object created from this factory will now be development objects.
 */

// Create a development factory.
$factory = new Config\Factory(['group' => 'development']);

// Load and return our mail
$mail = $factory->load('Mail');

// Echo the results
echo $mail['send'];                 // 'No'
echo $mail['message'];              // 'This is the default mail message'
echo $mail['details']['subject'];   // 'This is the development mail subject'

/**
 * Example 4.
 *
 * Changing the group of a factory.
 */

// Update the config to the production group.
$factory->config(['group' => 'production']);

// Load and return our mail
$mail = $factory->load('Mail');

// Echo the results
echo $mail['send'];                 // 'Yes'
echo $mail['message'];              // 'This is the production mail message.'
echo $mail['details']['subject'];   // 'This is the default mail subject'


/**
 * Example 5.
 *
 * We can still filter our results with a direct call, note we are
 * still using the factory which had its group set to production.
 */

echo $factory->mail('send');                // 'Yes'
echo $factory->mail('message');             // 'This is the production mail message.'
echo $factory->mail('details', 'subject');  // 'This is the default mail subject'


/**
 * Example 6.
 *
 * All of the above can also be accomplished from an instance.
 * The group is stored statically for instances
 */

// Set our group
Config\Instance::config(['group' => 'development']);

// Echo the results
echo Config\Instance::Mail('send');                 // 'No'
echo Config\Instance::Mail('message');              // 'This is the default mail message'
echo Config\Instance::Mail('details', 'subject');   // 'This is the development mail subject'

/**
 * Example 7.
 *
 * Finally, we can still use our default group directly, either by creating a new
 * factory, and not assigning a group or changing the existing group.
 */

// Create a new factory, with out a group.
$factory = new Config\Factory();

echo $factory->mail('details', 'message');   // 'This is the default mail message'


// Set our group
Config\Instance::config(['group' => 'default']);

// Echo the results
echo Config\Instance::Mail('send');                 // 'No'
echo Config\Instance::Mail('message');              // 'This is the default mail message'
echo Config\Instance::Mail('details', 'subject');   // 'This is the default mail subject'

/**
 * Example 8.
 *
 * If you call a group which doesn't exist, then your only going to get the default values back
 */
Config\Instance::config(['group' => 'IDontExist']);

// Echo the results
echo Config\Instance::Mail('send');                 // 'No'
echo Config\Instance::Mail('message');              // 'This is the default mail message'
echo Config\Instance::Mail('details', 'subject');   // 'This is the default mail subject'