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
 * MongoDb module configuration
 *
 * @package    Application
 */
return array(
    'service_manager' => array(
        'factories' => array(
            'MongoDb\Db\Adapter' => 'MongoDb\Db\AdapterFactory',
        ),
    ),
);
