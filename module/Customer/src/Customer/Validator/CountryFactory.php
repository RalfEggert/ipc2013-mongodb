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
namespace Customer\Validator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Country validator factory
 *
 * Factory to create the country validator
 *
 * @package    Customer
 */
class CountryFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     *
     * @param ServiceLocatorInterface $validatorPluginManager
     *
     * @return Country
     */
    public function createService(ServiceLocatorInterface $validatorPluginManager)
    {
        $config = $validatorPluginManager->getServiceLocator()->get('Config');

        $validator = new Country();
        $validator->setCountries(array_keys($config['country_list']));
        return $validator;
    }
}
