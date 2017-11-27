<?php



// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the config package
use Hive\Config;

// The configuration
class Mail extends Config\Library
{
    public static $default = [
        'send' => 'Yes',
        'message' => 'This is the mail message',
        'details' =>  [
            'subject'   => 'This is the mail subject',
            'from'      => 'Hive Config',
        ],
    ];
}


/**
 * Example 1
 *
 * The most simple example using the config package, this does not utilise the power of the config package.
 */

// Create an object
$mail = new Mail('default');

// Echo the results
echo $mail['send'];                 // 'Yes'
echo $mail['message'];              // 'This is the mail message'
echo $mail['details']['subject'];   // 'This is the mail subject'


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

