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

use Customer\Collection\CustomerCollection;
use Customer\Entity\CustomerEntity;
use Customer\InputFilter\CustomerFilter;
use MongoDb\Db\Exception\InvalidQueryException;
use MongoDb\Service\AbstractModelService;
use Zend\EventManager\EventManagerInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;

/**
 * Customer customer Service
 *
 * @package    Customer
 */
class CustomerService extends AbstractModelService
{
    /**
     * @var CustomerFilter
     */
    protected $filter;

    /**
     * Constructor
     *
     * @param EventManagerInterface $eventManager
     * @param CustomerCollection    $collection
     * @param CustomerFilter        $filter
     *
     * @return \Customer\Service\CustomerService
     */
    public function __construct(
        EventManagerInterface $eventManager, CustomerCollection $collection, CustomerFilter $filter
    ) {
        $eventManager->setIdentifiers(array(__CLASS__));

        $this->setEventManager($eventManager);
        $this->setCollection($collection);
        $this->setFilter($filter);
    }

    /**
     * Get filter
     *
     * @return CustomerFilter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Set filter
     *
     * @param CustomerFilter $filter
     *
     * @return $this
     */
    public function setFilter(CustomerFilter $filter)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * Delete existing customer
     *
     * @param integer $id customer id
     *
     * @return boolean
     */
    public function delete($id)
    {
        // fetch customer entity
        $customer = $this->fetchSingleById($id);

        // check customer
        if (!$customer) {
            $this->setMessage('Kunde konnte nicht gefunden werden');
            return false;
        }

        // delete existing customer
        try {
            $result = $this->getCollection()->delete($customer);
        } catch (InvalidQueryException $e) {
            $this->setMessage('Kunde konnte nicht gelöscht werden');
            return false;
        }

        // set success message
        $this->setMessage('Kunde wurde gelöscht');

        // return result
        return true;
    }

    /**
     * Save a customer
     *
     * @param array   $data   input data
     * @param integer $id     id of customer entry
     *
     * @return CustomerEntity
     */
    public function save(array $data, $id = null)
    {
        // get mode
        $mode = (!$id) ? 'insert' : 'update';

        // get customer
        $customer = ($mode == 'insert') ? new CustomerEntity()
            : $this->fetchSingleById($id);

        // check customer
        if (!$customer) {
            $this->setMessage('Kunde konnte nicht gefunden werden');
            return false;
        }

        // get filter and set data
        $filter = $this->getFilter();
        $filter->setData($data);

        // check for invalid data
        if (!$filter->isValid()) {
            $this->setMessage('Bitte Eingaben prüfen!');
            return false;
        }

        // get input hydrator
        $inputHydrator = new ArraySerializable();

        // get valid customer entity object
        $inputHydrator->hydrate($filter->getValues(), $customer);

        // insert new customer
        try {
            if ($mode == 'insert') {
                $id = $this->getCollection()->insert($customer);
            } else {
                $this->getCollection()->update($customer);
            }
        } catch (InvalidQueryException $e) {
            $this->setMessage('Kunde konnte nicht gespeichert werden');
            return false;
        }

        // reload customer
        $customer = $this->fetchSingleById($id);

        // set success message
        $this->setMessage('Kunde wurde gespeichert');

        // return customer
        return $customer;
    }

    /**
     * Fetch single by id
     *
     * @param varchar $id
     *
     * @return CustomerEntity
     */
    public function fetchSingleById($id)
    {
        return $this->getCollection()->fetchSingleById($id);
    }

    /**
     * Fetch list of customers
     *
     * @param string $country country code
     *
     * @return string
     */
    public function fetchList($country = null)
    {
        return $this->getCollection()->fetchList($country);
    }
}
