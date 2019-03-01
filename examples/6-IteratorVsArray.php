<?php

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

// Use the config
use Hive\Config;


// @todo

/**
 * Class iMail
 * By default Config will be an iterator, this doesnt need to be specified.
 */
class iMail extends Config\Library
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

var_dump(Config\Instance::iMail());

/*
 *  object(iMail)[2]
 *    private 'storage' (ArrayIterator) =>
 *      array (size=3)
 *        'send' => string 'Yes' (length=3)
 *        'message' => string 'This is the mail message' (length=24)
 *        'details' =>
 *        array (size=2)
 *          'subject' => string 'This is the mail subject' (length=24)
 *          'from' => string 'Hive Config' (length=11)
 */


/**
 * Class aMail
 *
 * We can easily change whether or not it is an iterator and instead it can be returned as an array.
 */
class aMail extends Config\Library
{
    /**
     * Whether or not to return an iterator or an array.
     * @var bool
     */
    public static $iterator = false;

    public static $default = [
        'send' => 'Yes',
        'message' => 'This is the mail message',
        'details' =>  [
            'subject'   => 'This is the mail subject',
            'from'      => 'Hive Config',
        ],
    ];
}

var_dump(Config\Instance::aMail());

/*
 *  array (size=3)
 *    'send' => string 'Yes' (length=3)
 *    'message' => string 'This is the mail message' (length=24)
 *    'details' =>
 *    array (size=2)
 *      'subject' => string 'This is the mail subject' (length=24)
 *      'from' => string 'Hive Config' (length=11)
 */
