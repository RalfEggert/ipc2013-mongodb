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
namespace MongoDb\Entity;

use Zend\Filter\StaticFilter;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * Abstract entity
 *
 * @package    MongoDb
 */
abstract class AbstractEntity implements ArraySerializableInterface
{
    /**
     * Clone an object
     */
    public function __clone()
    {
        foreach (get_object_vars($this) as $key => $value) {
            $getMethod = $this->buildMethodName($key, 'get');

            if (!method_exists($this, $getMethod)) {
                continue;
            }

            $setMethod = $this->buildMethodName($key, 'set');

            if (!method_exists($this, $setMethod)) {
                continue;
            }

            if ($this->$getMethod() instanceof AbstractEntity) {
                $this->$setMethod(clone $this->$getMethod());
            }
        }
    }

    /**
     * Build method name
     *
     * @param  string $key
     * @param  string $mode
     *
     * @return void
     */
    public function buildMethodName($key, $mode = 'get')
    {
        return $mode . StaticFilter::execute(
            $key, 'wordunderscoretocamelcase'
        );
    }

    /**
     * Exchange internal values from provided array
     *
     * @param  array $array
     *
     * @return void
     */
    public function exchangeArray(array $array)
    {
        // make sure to just set filled values and check for method
        foreach ($array as $key => $value) {
            $getMethod = $this->buildMethodName($key, 'get');

            if (!method_exists($this, $getMethod)) {
                continue;
            }

            $setMethod = $this->buildMethodName($key, 'set');

            if (!method_exists($this, $setMethod)) {
                continue;
            }

            if ($this->$getMethod() instanceof AbstractEntity) {
                $this->$getMethod()->exchangeArray($value);
            } else {
                $this->$setMethod($value);
            }
        }
    }

    /**
     * Return an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        $array = array();

        foreach (get_object_vars($this) as $key => $value) {
            $getMethod = $this->buildMethodName($key, 'get');

            if (!method_exists($this, $getMethod)) {
                continue;
            }

            if ($this->$getMethod() instanceof AbstractEntity) {
                $array[$key] = $this->$getMethod()->getArrayCopy();
            } else {
                $array[$key] = $this->$getMethod();
            }
        }

        return $array;
    }
}
