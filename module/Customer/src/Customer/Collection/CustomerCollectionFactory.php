<?php
/**
 * Zend Framework 2 feat. MongoDB
 *
 * Zend Framework Session auf der International PHP Conference 2013 in München
 *
 * @package    Customer
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * namespace definition and usage
 */
namespace Customer\Collection;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Customer table factory
 *
 * Factory to create the table gateway for customers
 *
 * @package    Customer
 */
class CustomerCollectionFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return CustomerCollection
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('MongoDb\Db\Adapter');
        $entity = $serviceLocator->get('Customer\Entity\Customer');

        $collection = new CustomerCollection($adapter, $entity);
        return $collection;
    }
}
