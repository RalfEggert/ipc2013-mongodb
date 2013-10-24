<?php
/**
 * Zend Framework 2 feat. MongoDB
 *
 * Zend Framework Session auf der International PHP Conference 2013 in München
 *
 * @package    MongoDb
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * namespace definition and usage
 */
namespace MongoDb\Db;

use MongoClient;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * MongoDb Adapter factory
 *
 * Factory to create the db adapter to the MongoDb client
 *
 * @package    MongoDb
 */
class AdapterFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CustomerCollection
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // get configuration data
        $config = $serviceLocator->get('config');

        // get database name
        $databaseName = $config['mongodb']['database'];

        // connect
        $client = new MongoClient();

        // select a database
        $database = $client->$databaseName;

        // return adapter
        return $database;
    }
}
