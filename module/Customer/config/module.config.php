<?php
/**
 * Zend Framework 2 feat. MongoDB
 *
 * Zend Framework Session auf der International PHP Conference 2013 in München
 *
 * @package    Application
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * Application module configuration
 *
 * @package    Application
 */
return array(
    'router'          => array(
        'routes' => array(
            'customer' => array(
                'type'          => 'Literal',
                'options'       => array(
                    'route'    => '/customer',
                    'defaults' => array(
                        'controller' => 'customer',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'action' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'       => '/:action[/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[a-zA-Z0-9]{24}',
                            ),
                        ),
                    ),
                    'page'   => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'       => '/:page',
                            'constraints' => array(
                                'page' => '[0-9_-]*',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'controllers'     => array(
        'factories' => array(
            'customer' => 'Customer\Controller\CustomerControllerFactory',
        ),
    ),

    'service_manager' => array(
        'invokables' => array(
            'Customer\Entity\Customer' => 'Customer\Entity\CustomerEntity',
        ),
        'factories'  => array(
            'Customer\Collection\Customer' => 'Customer\Collection\CustomerCollectionFactory',
            'Customer\Service\Customer'    => 'Customer\Service\CustomerServiceFactory',
        ),
        'shared'     => array(
            'Customer\Entity\Customer' => false,
        ),
    ),

    'validators'      => array(
        'factories' => array(
            'Customer\Country' => 'Customer\Validator\CountryFactory',
        ),
        'shared'    => array(
            'Customer\Country' => true,
        ),
    ),

    'input_filters'   => array(
        'invokables' => array(
            'Customer\CustomerAddressFilter' => 'Customer\InputFilter\CustomerAddressFilter',
            'Customer\CustomerFilter'        => 'Customer\InputFilter\CustomerFilter',
        ),
        'shared'     => array(
            'Customer\CustomerAddressFilter' => true,
            'Customer\CustomerFilter'        => true,
        ),
    ),

    'form_elements'   => array(
        'invokables' => array(
            'Customer\CustomerAddressFieldset' => 'Customer\Form\CustomerAddressFieldset',
        ),
        'factories'  => array(
            'Customer\CustomerForm' => 'Customer\Form\CustomerFormFactory',
        ),
        'shared'     => array(
            'Customer\CustomerAddressFieldset' => true,
            'Customer\CustomerForm'            => true,
        ),
    ),

    'view_helpers'    => array(
        'factories' => array(
            'customerCountry' => 'Customer\View\Helper\CustomerCountryFactory',
        ),
    ),

    'view_manager'    => array(
        'template_map'        => include __DIR__ . '/../view/template_map.php',
        'template_path_stack' => array(__DIR__ . '/../view',),
    ),

    'country_list'    => array(
        'de' => 'Deutschland',
        'ch' => 'Schweiz',
        'at' => 'Österreich',
    ),
);
