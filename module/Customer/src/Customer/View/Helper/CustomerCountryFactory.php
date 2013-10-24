<?php
/**
 * Zend Framework 2 feat. MongoDB
 *
 * Zend Framework Session auf der International PHP Conference 2013 in München
 *
 * @package    Part3
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * namespace definition and usage
 */
namespace Customer\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Generates the show random product view helper object
 *
 * @package    Part3
 */
class CustomerCountryFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     *
     * @param \Zend\ServiceManager\ServiceLocatorInterface $helperManager
     *
     * @return CustomerCountry
     */
    public function createService(ServiceLocatorInterface $helperManager)
    {
        $config = $helperManager->getServiceLocator()->get('Config');

        $helper = new CustomerCountry();
        $helper->setCountryList($config['country_list']);

        return $helper;
    }
}
