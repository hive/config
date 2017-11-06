# Hive Benchmark
[![Latest Stable Version](https://poser.pugx.org/hive/config/v/stable?format=flat-square)](https://packagist.org/packages/hive/config)
[![Latest Unstable Version](https://poser.pugx.org/hive/config/v/unstable?format=flat-square)](https://packagist.org/packages/hive/config)
[![License](https://poser.pugx.org/hive/config/license?format=flat-square)](https://packagist.org/packages/hive/config)
[![composer.lock](https://poser.pugx.org/hive/config/composerlock?format=flat-square)](https://packagist.org/packages/hive/config)
[![Build Status](https://img.shields.io/travis/hive/config/master.svg?style=flat-square)](https://travis-ci.org/hive/config)


Simple decoupled config, In Development


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
 
**Get the Config**
 
 ```php    
    print_r(\Hive\Config\Instance::Mail());
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


**Get the Config**

```php

    /**
     * As the group is being set on the instance, this will remain the 'group' for all
     * configuration instances, until changed.
     */
    $config         = new Config\Instance();
    $config::$group = 'development';
    print_r( $config::Mail() );

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
 * Limitations with in php5, will cause a colliding constructor definitions with a trait named __constructor. There is an easy solution, you just have to alias the trait, see out [example](https://github.com/hive/config/tree/master/examples
 * Notes about inheriting.
    * It is possible to inherit a config class, in which case the settings from the parent will also be inherited.
    * Items will give preference to themselves over parents, ie. object/$sever > object/$default > parent/$server > parent/$default
    * At the moment, the child is required to declare the default property if the parent uses it, otherwise it will override.
    
#### Outstanding

  * Unit Cases
  * Examples
  * Rename internal environment variable to group    
 
## Advance 

The config library has many more options and features, to view them please see our [examples](https://github.com/hive/config/tree/master/examples)

## File Map

The code is split up into the following classes : 


1. /Tests : folder for any unit testing
2. /Examples : folder for any examples
3. /Documents : folder for any documentation  
4. /Source : folder for source code
    1. Library.php : The actual config library, useful for extending functionality.
        *  __construct
    2. Instance.php : Instance of the object class.
        * static __callStatic
    3. Exception : Folder for any exceptions the object will throw.
        * InstanceDoesNotExist.php
    4. Mixin : Folder for any mix-ins (traits)
        * Library.php the trait to include to for easy implentation.
    5. Contact : folder for any interfaces or abstract classes they implement
        * Instance.php
        * Library.php
        
The full API documentation can be found [here](https://hive.github.io/config/html/phpdox/index.xhtml) or all the documentation can be found [here](https://hive.github.io/config/)