<?php
/**
 * Zend Framework 2 feat. MongoDB
 *
 * Zend Framework Session auf der International PHP Conference 2013 in München
 *
 * @package    MongoDb
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * namespace definition and usage
 */
namespace MongoDb\Db\Exception;

use UnexpectedValueException;

/**
 * MongoDb Adapter query exception
 *
 * @package    MongoDb
 */
class InvalidQueryException extends UnexpectedValueException
{
}
