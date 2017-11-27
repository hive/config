# Hive Config
[![Latest Stable Version](https://poser.pugx.org/hive/config/v/stable?format=flat-square)](https://packagist.org/packages/hive/config)
[![Latest Unstable Version](https://poser.pugx.org/hive/config/v/unstable?format=flat-square)](https://packagist.org/packages/hive/config)
[![License](https://poser.pugx.org/hive/config/license?format=flat-square)](https://packagist.org/packages/hive/config)
[![composer.lock](https://poser.pugx.org/hive/config/composerlock?format=flat-square)](https://packagist.org/packages/hive/config)
[![Build Status](https://img.shields.io/travis/hive/config/master.svg?style=flat-square)](https://travis-ci.org/hive/config)


Simple decoupled config, Version 1.0.*


## Documentation

[https://hive.github.io/config/](https://hive.github.io/config/).

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
        "Hive/Config": "dev-master"
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
  * Examples
  * Submit to packagist
  * Tag.  
 
## Advance 

The config library has many more options and features, to view them please see our [examples](https://github.com/hive/config/tree/master/examples)

## File Map

The code is split up into the following classes : 


1. /tests : folder for any unit testing
2. /examples : folder for any examples
3. /docs : folder for any documentation  
4. /source : folder for source code
    1. Library.php : The actual config library, useful for extending functionality.
        *  __construct
    2. Instance.php : Instance of the object class.
        * static load
        * static config
        * static __callStatic
    3. Factory.php : Factory to create the object class.
        * load
        * config
        * __call
    4. Exception : Folder for any exceptions the object will throw.
        * ClassDoesNotExist.php
    5. Mixin : Folder for any mix-ins (traits)
        * Library.php the trait to include to for easy implementation.
    6. Contact : folder for any interfaces or abstract classes they implement
        * Instance.php
        * Library.php
        * Factory.php
        
The full API documentation can be found [here](https://hive.github.io/config/html/phpdox/index.xhtml) or all the documentation can be found [here](https://hive.github.io/config/)