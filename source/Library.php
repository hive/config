<?php namespace Hive\Config;

/**
 * Config Library.
 *
 * Will give access to its ArrayIterator, at which stage anything to do with the group
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
     * Takes a Config Class that throws away the environment for use as an array iterator.
     *
     * @param       $group
     * @param array $array
     */
    public function __construct($group, array $array = [])
    {
        // Discard the Group.
        unset($group);

        parent::__construct($array);
    }
}
