<?php

/**
 * It is possible to extend your config classes and inheriting common values.
 *
 * In the last set of examples, we used groups for our production and development environments.
 *
 * In this example we will separating our config out into two classes, one for mail and one for email but as they have
 * configuration items we want to share the email config will inherit from the mail config. This is where things start to get
 * really useful.
 *
 * There are some things to note when extending a class.
 *
 * 1) Items will give preference to themselves over parents, ie. object/$group > object/$default > parent/$group > parent/$default
 * 2) At the moment, the child is required to declare the default property if the parent uses it, otherwise it will override.
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the config
use Hive\Config;

// The mail configuration class.
class Mail extends Config\Library
{

    public static $default = [
        'send' => 'No',
        'stamp' => 'Yes',
        'message'   => 'This is the default mail message',
        'details'   =>  [
            'subject'   => 'This is the default mail subject',
            'from'      => 'Hive Config Mail Default',
        ]
    ];


    public static $production = [
        'send'          => 'Yes',
        'message'       => 'This is the production mail message.',
    ];

    public static $development = [
        'details' =>  [
            'subject'   => 'This is the development mail subject',
            'from'      => 'Hive Config Mail Development',
        ]
    ];
}


// The email configuration class.
class Email extends \Mail
{

    public static $default = [
        'stamp' => 'No',
        'details' =>  [
            'subject'   => 'Email Default Subject',
            'from'      => 'Hive Config Email Default',
            'address'   => 'wax@hive.com.au'
        ],
    ];


    public static $production = [
        'message'       => 'This is the production email message.'
    ];

    public static $development = [
        'details' =>  [
            'from'      => 'Hive Config Email Development',
            'address'   => 'wax@localhost',
        ]
    ];
}


/**
 * Example 1.
 *
 * The mail object will continue to work as we have seen in the past.
 */


// Create a development object
$mail = new Mail('development');

// Echo the results
echo $mail['send'];                 // 'No'
echo $mail['stamp'];                // 'Yes'
echo $mail['message'];              // 'This is the default mail message'
echo $mail['details']['subject'];   // 'This is the development mail subject'



/**
 * Example 2.
 *
 * Our new Email config, will inherit both its group configuration and parent configuration.
 *
 * As the email class extends the mail class, the mails class values (for the default group)
 * Will also be added.
 */

$email = new Email('development');

// Echo the results
echo $email['send'];                    // 'No'
echo $email['stamp'];                   // 'No'
echo $email['message'];                 // 'This is the default mail message'
echo $email['details']['from'];         // 'Hive Config Email Development'
echo $email['details']['subject'];      // 'Email Default Subject'

/**
 * Example 3.
 * This shows, using the factory development group with a config which is extended.
 *
 * The package will gather the email development values, and as the Mail does not have a development
 * it will return the default message.
 *
 * Items will give preference to their own items over their parents. ie.
 *
 * Email/Group > Email/Default > Mail/Group > Mail/Default.
 *
 */

// Create a development factory.
$factory = new Config\Factory(['group' => 'production']);

// Load and return our mail
$email = $factory->load('Email');

// Echo the results
echo $email['send'];                    // 'Yes', this comes from the mail::$production
echo $email['stamp'];                   // 'No', this comes from email::$default
echo $email['message'];                 // 'This is the production email message.', this comes from email::$production
echo $email['details']['from'];         // 'Hive Config Email Default', this comes from email::$default['details']['from']
echo $email['details']['subject'];      // 'Email Default Subject', this comes from email::$default['details']['from']


/**
 * Example 4.
 *
 * Obviously all of this can also be done through an instance and with arguments.
 *
 * Below we are mixing things up a bit by returning a configuration item, and accessing
 * it through its array.
 */
$factory = Config\Instance::config(['group' => 'production']);


// Echo the results
echo Config\Instance::Email('send');                    // 'Yes', this comes from the mail::$production
echo Config\Instance::Email('stamp');                   // 'No', this comes from email::$default
echo Config\Instance::Email()['message'];               // 'This is the production email message.', this comes from email::$production
echo Config\Instance::Email('details', 'from');         // 'Hive Config Email Default', this comes from email::$default['details']['from']
echo Config\Instance::Email()['details']['subject'];    // 'Email Default Subject', this comes from email::$default['details']['from']

/**
 * Example 5.
 *
 * Which group is used, is obviously set at run time for the factory,
 * but this is also how the instance will work, it will keep its current group across states.
 *
 * However if you do change the group, the config will reflect this.
 */

// Echo our current group
echo Config\Instance::config()['group'];    // 'production'

// Echo our current email message (We are still using production).
echo Config\Instance::Email('message');   // 'This is the production email message.', this comes from email::$production

// Change our current group from production to development.
Config\Instance::config(['group' => 'development']);

// Echo our current email message (now we are in in development).
echo Config\Instance::Email('message');   // 'This is the default mail message', this comes from email::$default

// Echo our current mail message (we are still using development).
echo Config\Instance::Mail('details', 'from');   // 'Hive Config Mail Development', this comes from mail::$development


