<?php namespace Hive\Config;

/**
 * Config Library.
 *
 * Will give access to its ArrayIterator, at which stage anything to do with the environment
 * is ready to be discarded.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/Config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2016 Jamie  Peake
 */
class Library extends \ArrayIterator implements Contract\Library
{
    /**
     * Item constructor.
     *
     * Takes a Config Contract that throws away the environment for use as an array iterator.
     *
     * @param       $environment
     * @param array $array
     */
    public function __construct($environment, array $array = [])
    {
        parent::__construct($array);
    }
}
