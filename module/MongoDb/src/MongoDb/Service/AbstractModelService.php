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
namespace MongoDb\Service;

use MongoDb\Collection\AbstractCollection;
use Zend\EventManager\EventManagerInterface;
use MongoDb\Entity\AbstractEntity;

/**
 * Abstract model service
 *
 * @package    MongoDb
 */
abstract class AbstractModelService
{
    /**
     * @var AbstractCollection
     */
    protected $collection;

    /**
     * @var EventManagerInterface
     */
    protected $eventManager = null;

    /**
     * @var string
     */
    protected $message = null;

    /**
     * Get collection
     *
     * @return AbstractCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set collection
     *
     * @param AbstractCollection $collection
     *
     * @return AbstractCollection
     */
    public function setCollection(AbstractCollection $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Retrieve the event manager
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }

    /**
     * Inject an EventManager instance
     *
     * @param  EventManagerInterface $eventManager
     *
     * @return void
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * Get service message
     *
     * @return array
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Clear service message
     */
    public function clearMessage()
    {
        $this->message = null;
    }

    /**
     * Add service message
     *
     * @param string new message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Save data
     *
     * @param array   $data input data
     * @param integer $id   id of entry
     *
     * @return AbstractEntity
     */
    abstract public function save(array $data, $id = null);

    /**
     * Delete existing entity
     *
     * @param integer $id id
     *
     * @return boolean
     */
    abstract public function delete($id);
}
