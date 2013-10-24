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

use Zend\Validator\AbstractValidator;

/**
 * Check country validator
 *
 * @package    Customer
 */
class Country extends AbstractValidator
{
    /**
     * constants
     */
    const INVALID_COUNTRY = 'countryInvalid';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $messageTemplates
        = array(
            self::INVALID_COUNTRY => "Country code '%value%' is invalid!",
        );

    /**
     * Valid countries numbers
     *
     * @var array
     */
    protected $countries = array();

    /**
     * Set countries
     *
     * @param array $countries list of valid countries
     */
    public function setCountries(array $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Check if value is a valid country code
     *
     * @param  mixed $value
     *
     * @return mixed
     */
    public function isValid($value)
    {
        $value = (string)$value;

        $this->setValue($value);

        if (!in_array($value, $this->countries)) {
            $this->error(self::INVALID_COUNTRY);
            return false;
        }

        return true;
    }
}
