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
namespace Customer\Form;

use Zend\Form\Form;

/**
 * Customer form
 *
 * Form for the customer
 *
 * @package    Customer
 */
class CustomerForm extends Form
{
    /**
     * Country options
     *
     * @var array
     */
    protected $_countryOptions = array();

    /**
     * Constructor
     */
    public function __construct(array $countryOptions)
    {
        parent::__construct('customer_form');

        $this->_countryOptions = $countryOptions;
    }

    /**
     * Build form
     */
    public function init()
    {
        $this->add(
            array(
                'type' => 'Csrf',
                'name' => 'csrf',
            )
        );

        $this->add(
            array(
                'type'       => 'Text',
                'name'       => 'firstname',
                'options'    => array(
                    'label' => 'Vorname',
                ),
                'attributes' => array(
                    'class' => 'span5',
                ),
            )
        );

        $this->add(
            array(
                'type'       => 'Text',
                'name'       => 'lastname',
                'options'    => array(
                    'label' => 'Nachname',
                ),
                'attributes' => array(
                    'class' => 'span5',
                ),
            )
        );


        $this->add(
            array(
                'type' => 'Customer\CustomerAddressFieldset',
                'name' => 'address',
            )
        );

        $this->add(
            array(
                'type'       => 'Select',
                'name'       => 'country',
                'options'    => array(
                    'label'         => 'Land',
                    'value_options' => $this->_countryOptions,
                ),
                'attributes' => array(
                    'class' => 'span5',
                ),
            )
        );

        $this->add(
            array(
                'type'       => 'Submit',
                'name'       => 'save',
                'options'    => array(),
                'attributes' => array(
                    'value' => 'Speichern',
                    'id'    => 'save',
                    'class' => 'btn btn-primary',
                ),
            )
        );
    }
}
