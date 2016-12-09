# Hive Config
[![Latest Stable Version](https://poser.pugx.org/hive/Config/v/stable?format=flat-square)](https://packagist.org/packages/hive/Config)
[![Latest Unstable Version](https://poser.pugx.org/hive/Config/v/unstable?format=flat-square)](https://packagist.org/packages/hive/Config)
[![License](https://poser.pugx.org/hive/Config/license?format=flat-square)](https://packagist.org/packages/hive/Config)
[![composer.lock](https://poser.pugx.org/hive/Config/composerlock?format=flat-square)](https://packagist.org/packages/hive/Config)


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

1. Library.php : The actual benchmarking library, useful for extending functionality.
2. Object.php : Class for accessing the benchmark object.
3. Instance.php : Instance of the object class.

## Useage
-------
 ```php
    use hive\Config;
 ```
 
