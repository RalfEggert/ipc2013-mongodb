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
namespace MongoDb\Collection;

use MongoCollection;
use MongoDB;
use MongoDb\Entity\AbstractEntity;
use MongoId;

/**
 * Abstract collection
 *
 * Abstract collection class to represent a mongodb collection
 *
 * @package    MongoDb
 */
abstract class AbstractCollection
{
    /**
     * @var MongoCollection
     */
    protected $collection = null;

    /**
     * @var string
     */
    protected $collectionName = null;

    /**
     * @var AbstractEntity
     */
    protected $prototype = null;

    /**
     * Constructor
     *
     * @param MongoDb        $adapter
     * @param AbstractEntity $prototype
     */
    public function __construct(MongoDB $adapter, AbstractEntity $prototype)
    {
        $this->setCollection($adapter, $this->collectionName);
        $this->setPrototype($prototype);
    }

    /**
     * Find document list in collection
     *
     * @param array $searchCriteria
     *
     * @return array
     */
    protected function find(array $searchCriteria = array())
    {
        $resultSet = array();

        foreach ($this->getCollection()->find($searchCriteria) as $resultRow) {
            $entity = clone $this->getPrototype();
            $entity->exchangeArray($resultRow);

            $resultSet[] = $entity;
        }

        return $resultSet;
    }

    /**
     * Find single document in collection
     *
     * @param int $id id of document
     *
     * @return AbstractEntity
     */
    public function findOne($id)
    {
        $searchCriteria = array('_id' => new MongoId($id));

        $resultRow = $this->getCollection()->findOne($searchCriteria);

        if (is_null($resultRow)) {
            return false;
        }

        $entity = clone $this->getPrototype();
        $entity->exchangeArray($resultRow);

        return $entity;
    }

    /**
     * Get collection
     *
     * @return MongoCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set collection
     *
     * @param MongoDB $adapter
     * @param string  $collectionName
     *
     * @return $this
     */
    public function setCollection(MongoDB $adapter, $collectionName = null)
    {
        $this->collection = $adapter->$collectionName;

        return $this;
    }

    /**
     * Get prototype
     *
     * @return AbstractEntity
     */
    public function getPrototype()
    {
        return $this->prototype;
    }

    /**
     * Set prototype
     *
     * @param AbstractEntity $prototype
     *
     * @return $this
     */
    public function setPrototype(AbstractEntity $prototype)
    {
        $this->prototype = $prototype;

        return $this;
    }

    /**
     * Insert entity
     *
     * @param AbstractEntity $entity
     *
     * @return string
     */
    public function insert(AbstractEntity $entity)
    {
        $id = new MongoId();

        $entityData = $entity->getArrayCopy();
        $entityData['_id'] = $id;

        $this->getCollection()->insert($entityData);

        return (string) $id;
    }

    /**
     * Update entity
     *
     * @param AbstractEntity $entity
     *
     * @return string
     */
    public function update(AbstractEntity $entity)
    {
        $id = new MongoId($entity->getId());

        $searchCriteria = array('_id' => $id);

        $entityData = $entity->getArrayCopy();
        unset($entityData['_id']);

        $this->getCollection()->update($searchCriteria, $entityData);

        return (string) $id;
    }

    /**
     * Delete entity
     *
     * @param AbstractEntity $entity
     *
     * @return string
     */
    public function delete(AbstractEntity $entity)
    {
        $id = new MongoId($entity->getId());

        $searchCriteria = array('_id' => $id);

        $this->getCollection()->remove($searchCriteria);

        return (string) $id;
    }
}
