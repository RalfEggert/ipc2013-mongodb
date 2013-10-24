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
namespace Customer\Entity;

use MongoDb\Entity\AbstractEntity;

/**
 * Customer entity
 *
 * Entity to represent a customer
 *
 * @package    Customer
 */
class CustomerEntity extends AbstractEntity
{
    protected $_id;
    protected $firstname;
    protected $lastname;
    protected $country;

    /**
     * @var AddressEntity
     */
    protected $address;

    /**
     * Constructor to build entity hierarchie
     */
    public function __construct()
    {
        $this->setAddress(new AddressEntity());
    }

    /**
     * Set id
     *
     * @param $id
     */
    public function setId($id)
    {
        $this->_id = (string) $id;
    }

    /**
     * Get id
     *
     * @return string $id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get lastname
     *
     * @return string $lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set address
     *
     * @param AddressEntity $address
     */
    public function setAddress(AddressEntity $address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return AddressEntity
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }
}
