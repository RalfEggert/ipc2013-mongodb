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
namespace Customer\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Customer service factory
 *
 * Factory to create the model-service for customers
 *
 * @package    Customer
 */
class CustomerServiceFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return CustomerService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $inputFilterManager = $serviceLocator->get('InputFilterManager');

        $eventManager = $serviceLocator->get('EventManager');
        $collection = $serviceLocator->get('Customer\Collection\Customer');
        $filter = $inputFilterManager->get('Customer\CustomerFilter');

        $service = new CustomerService($eventManager, $collection, $filter);
        return $service;
    }
}
