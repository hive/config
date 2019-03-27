# Hive Config
[![License](https://poser.pugx.org/hive/config/license?format=flat-square)](https://packagist.org/packages/hive/config)
[![Latest Stable Version](https://poser.pugx.org/hive/config/v/stable?format=flat-square)](https://packagist.org/packages/hive/config)
[![Latest Unstable Version](https://poser.pugx.org/hive/config/v/unstable?format=flat-square)](https://packagist.org/packages/hive/config)
[![composer.lock](https://poser.pugx.org/hive/config/composerlock?format=flat-square)](https://packagist.org/packages/hive/config)
[![Build Status](https://img.shields.io/travis/hive/config/master.svg?style=flat-square)](https://travis-ci.org/hive/config)


Simple decoupled config, Version 1.0.*


## [Documentation](https://hive.github.io/config/)

 * [Getting Started](https://hive.github.io/config/).
 * [API](https://hive.github.io/config/html/phpdox/index.xhtml).
 * [Unit Tests](https://hive.github.io/config/html/phpunit/index.html).
 * [Coverage Dashboard](https://hive.github.io/config/html/coverage/dashboard.html).
 * [Coverage Details](https://hive.github.io/config/html/coverage/index.html).
 * Metrics [Version 1.10](https://hive.github.io/config/html/phpmetrics1/index.html) [Version 2.3](https://hive.github.io/config/html/phpmetrics2/index.html).
 * [Coding Standard](https://hive.github.io/config/html/codesniffer/index.html).
 * [Copy/Paste Detector](https://hive.github.io/config/html/phpcpd/index.html).
 * [Mess Detector](https://hive.github.io/config/html/phpmd/index.html).
 * [Statistics](https://hive.github.io/config/html/phploc/index.html).
 * [Examples](https://github.com/hive/config/tree/master/examples)

## Overview 

The config library allows _easy_ access to a configuration array. Furthermore it has the following options
1. Autoload configuration file and return an array
2. Instance support and easy syntax. ie. Config::Router();
3. Cascading, cascade the configuration options by inheritance.
4. Supports default values
5. Support Grouping, turn return different results based upon which group is set. (Great for environment variables)
6. Full Default, Group and Cascade integration.
7. Easy to implement, just include use the trait.

## Installation

Recommended installation [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "Hive/Config": "1.0.*"
    }
}
```

Via Composer Command line

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Install the latest version
composer require Hive/Config

```

```php
// With in your php file, include composers autoloader
require 'vendor/autoload.php';
```

Via Git

```bash
# Clone the repo
cd helloworld.dev
git clone https://github.com/hive/config.git . 
```

```php
// With in your php file, include composers autoloader
require 'hive/config/include.php';
```


## Useage
-------
 ```php
    use Hive\Config;
 ```
 
 
 **Configuration Class**
 ```php
 
    // The configuration class
    class Mail extends \Hive\Config\Library
    {
        use \Hive\Config\Mixin\Library;

        public static $default = [
            'subject'   => 'Wax',
            'from'      => 'wax@hive.com.au',
        ];
    }
 
 ```
 
**Print the Config**
 
 ```php    
    print_r(Config\Instance::Mail());
```

The above example will output 

```php    
    /**
     * Output
     */
    Array
     (
         [subject] => 'Wax'
         [from] => 'wax@hive.com.au'
     )
        
 ```
#### Grouping with Default Values
   
Full examples can be found with in the [examples](https://github.com/hive/config/tree/master/examples) folder.    
   
**Configuration Class**

```php

    // The configuration class
    class Mail extends \Hive\Config\Library
    {
        use \Hive\Config\Mixin\Library;

        public static $default = [
            'subject'   => 'Wax',
            'from'      => 'wax@hive.com.au',
        ];
        public static $development = [
            'from'      => 'developer@hive.com.au',
        ];
    }

```


**Print the Config**

```php

    /**
     * As the group is being set on the instance, this will remain the 'group' for all
     * configuration instances, until changed.
     */
    Config\Instance::config(['group' => 'development']);
    print_r( Config\Instance::Mail() );

```

```php    
    /**
     * Output
     */
    Array
     (
         [subject] => 'Wax'
         [from] => 'developer@hive.com.au'
     )
        
 ```

## Notes

 * PhpMetrics scores are not currently taking into account phpUnit test or code coverage.  
 * Limitations with in php5, will cause a colliding constructor definitions with a trait named __constructor. There is an easy solution, you just have to alias the trait, see out [example](https://github.com/hive/config/tree/master/examples)
 * Notes about inheriting.
    * It is possible to inherit a config class, in which case the settings from the parent will also be inherited.
    * Items will give preference to themselves over parents, ie. object/$sever > object/$default > parent/$server > parent/$default
    * At the moment, the child is required to declare the default property if the parent uses it, otherwise it will override.
 * TravisCI is currently showing a pass regardless of whether or not the unit tests fail, however it is actually currently passing. 
    
#### Outstanding

  * Unit Cases has met minimum exception testing at 100% code coverage, however outstanding
    * Group Testing
    * Inheritance Groups
    * Deep array, and their use of an instance with the static arguments. 
 
## Advance 

The config library has many more options and features, to view them please see our [examples](https://github.com/hive/config/tree/master/examples)

## File Map

The code is split up into the following classes : 


1. [tests](tests) : folder for any unit testing
2. [examples](examples) : folder for any examples
3. [docs](docs) : folder for any documentation
4. [source](source) : folder for source code
    1. [Library](source/Library.php) : The actual library, useful for extending functionality.
        *  __construct( array $config )
    2. [Instance](source/Instance.php) : Instance of the object class.
        * static load
        * static config
        * static __callStatic
    2. [Factory](source/Factory.php) : Factory to create the object class.
        * load
        * config
        * __call
    4. [Exception](source/Exception) : Folder for any exceptions the object will throw.
        * [ClassDoesNotExist](source/Exception/ClassDoesNotExist.php)
    5. [Mixin](source/Exception) : older for any mix-ins (traits)
        * [Library](source/Mixin/Library.php) the trait to include to for easy implementation.
    6. [Contract](source/Contract) : folder for any interfaces or abstract classes they implement
        * [Instance](source/Contract/Instance.php)
        * [Library](source/Contract/Library.php)
        * [Object](source/Contract/Object.php)
        
The full API documentation can be found [here](https://hive.github.io/config/html/phpdox/index.xhtml) or all the documentation can be found [here](https://hive.github.io/config/)