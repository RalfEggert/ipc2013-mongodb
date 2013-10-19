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
 * Local configuration
 * 
 * @package    Application
 */
return array(
    'db' => array(
        'dsn'     => 'mysql:dbname=schulung-null821;host=localhost;charset=utf8',
        'user'    => 'null821',
        'pass'    => 'null821',
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Application\Db\ProfilingAdapterFactory',
        ),
    ),
);
