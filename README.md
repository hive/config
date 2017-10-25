# Hive Config
[![Latest Stable Version](https://poser.pugx.org/hive/config/v/stable?format=flat-square)](https://packagist.org/packages/hive/config)
[![Latest Unstable Version](https://poser.pugx.org/hive/config/v/unstable?format=flat-square)](https://packagist.org/packages/hive/config)
[![License](https://poser.pugx.org/hive/config/license?format=flat-square)](https://packagist.org/packages/hive/config)
[![composer.lock](https://poser.pugx.org/hive/config/composerlock?format=flat-square)](https://packagist.org/packages/hive/config)


Simple decoupled Config, Version 1.0 currently being developed

## Notes


Version 1.0 Outstanding Items 
 * 

## Installation

Recommended installation [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "hive/Config": "dev-master"
    }
}
```

Via Composer Command line

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Install the latest version
composer require hive/Config

```

```php
// With in your php file, include composers autoloader
require 'vendor/autoload.php';
```

Via Git

```bash
# Clone the repo
cd helloworld.dev
git clone https://github.com/hive/Config.git . 
```

```php
// With in your php file, include composers autoloader
require 'hive/Config/include.php';
```

## Overview

The code is split up into the following classes : 



## Useage
-------
 ```php
    use hive\Config;
 ```
 
 
 ## Notes about Inheriting 
 
  - It is possible to inherit a config class, in which case the settings from the parent will also be inherited. 
  - Items will give preference to themselves over parents, ie. object/$sever > object/$default > parent/$server > parent/$default
  - At the moment, the child requires to declare the default property if the parent uses it, otherwise it will override. 
  
