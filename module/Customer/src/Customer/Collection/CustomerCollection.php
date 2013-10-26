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

use Customer\Entity\CustomerEntity;
use MongoDb\Collection\AbstractCollection;

/**
 * Customer collection
 *
 * Collection to represent a customer
 *
 * @package    Customer
 */
class CustomerCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $collectionName = 'customers';

    /**
     * Fetch list of customers
     *
     * @param integer $country country code
     *
     * @return array
     */
    public function fetchList($country = null)
    {
        $searchCriteria = array();

        if (!is_null($country)) {
            $searchCriteria['country'] = $country;
        }

        return $this->find($searchCriteria);
    }

    /**
     * Fetch single customer by id
     *
     * @param int $id id of customer
     *
     * @return CustomerEntity
     */
    public function fetchSingleById($id)
    {
        return $this->findOne($id);
    }

    /**
     * Setup test data for collection
     *
     * @return boolean
     */
    public function setupData()
    {
        $this->getCollection()->remove(array());

        $this->getCollection()->insert(
            array(
                'firstname' => 'Berta',
                'lastname'  => 'Huber',
                'country'   => 'at',
                'address'   => array(
                    'street'   => 'An der Wiesen 123',
                    'postcode' => '98760',
                    'city'     => 'Gottbacherl',
                ),
            )
        );

        $this->getCollection()->insert(
            array(
                'firstname' => 'Paula',
                'lastname'  => 'Paulsen',
                'country'   => 'de',
                'address'   => array(
                    'street'   => 'Am Testen 123',
                    'postcode' => '98765',
                    'city'     => 'Testhausen',
                ),
            )
        );

        $this->getCollection()->insert(
            array(
                'firstname' => 'Peter',
                'lastname'  => 'Petersen',
                'country'   => 'de',
                'address'   => array(
                    'street'   => 'Musterstraße 17',
                    'postcode' => '12456',
                    'city'     => 'Musterhausen',
                ),
            )
        );

        return true;
    }
}
