<?php namespace Hive\Config\Contract;

/**
 * Object Interface.
 *
 * Interface for the object class used as a contract.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/Config/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Config
 *
 * @copyright (c) 2016 Jamie Peake
 */
interface Object extends Library
{
    public function __construct($environment, array $options);
}
