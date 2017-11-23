<?php



// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the benchmark
use Hive\Config;

// The configuration
class Mail extends Config\Library
{
    public static $default = [
        'header' =>  [
            'subject'   => 'Wax',
            'from'      => 'wax@hive.com.au',
        ],
        'message'       => 'This is the message'
    ];

}


/**
 * The most simple example using the config package, this does not utilise the power of the config package.
 */

// Create an object
$config = new Mail('default');

// Print the results
print_r($config);


/**
 * This shows, using the factory in its most simplest form, which is not very different calling the class.
 */

// Create a factory
$config = new Config/Factory();

// Load and return our mail
$mail = $config->load('Mail');

// print the results
print_r($mail);

/**
 * We can also directly call the factory and the filter the results
 */

// We do not actually need a new factory in this file.
$config = new Config/Factory();

// Get the mail object
$mail = $config->mail();

// Or directly get the subject
$subject = $config->mail('header', 'subject');

// print the results
print_r($mail);
print_r($subject);

/**
 * All of the above can also be accomplished from an instance.
 */

// Quickly get our mail config
print_r(Config/Instance::Mail());

// Directly get our subject
print_r(Config/Instance::Mail('header', 'subject'));

