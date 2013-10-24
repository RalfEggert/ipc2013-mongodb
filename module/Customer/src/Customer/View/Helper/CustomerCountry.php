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
namespace Customer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Customer\Entity\CustomerEntity;

/**
 * Show customer country view helper
 *
 * @package    Customer
 */
class CustomerCountry extends AbstractHelper
{
    /**
     * Country List
     *
     * @var array
     */
    protected $countryList;


    /**
     * Sets Country List
     *
     * @param  array $countryList
     *
     * @return AbstractHelper
     */
    public function setCountryList(array $countryList)
    {
        $this->countryList = $countryList;
        return $this;
    }

    /**
     * Returns Country List
     *
     * @param $country
     *
     * @return string
     */
    public function getCountry($country)
    {
        if (isset($this->countryList[$country])) {
            return $this->countryList[$country];
        }

        return '-';
    }

    /**
     * Outputs customer country
     *
     * @param CustomerEntity $customerEntity
     *
     * @return string
     */
    public function __invoke(CustomerEntity $customerEntity)
    {
        return $this->getCountry($customerEntity->getCountry());
    }
}
