<?php
/**
 * Zend Framework Schulung
 * 
 * @package    Application
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.zendframeworkschulung.de/
 */

/**
 * Global configuration
 * 
 * @package    Application
 */
return array(
    'db' => array(
        'driver'  => 'Pdo',
        'dsn'     => 'mysql:dbname=secretdatabase;host=dbserver1;charset=utf8',
        'user'    => 'geheim',
        'pass'    => 'geheim',
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
