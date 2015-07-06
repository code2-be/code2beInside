<?php

namespace Code2be\Connection;

use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;

class Connection {

    public static function connect() {
        // Paramaters for database connections
        $parser = new \Symfony\Component\Yaml\Parser;
        $yaml   = $parser->parse(file_get_contents(__ROOT__ . '/app/config/parameters.yml'));

        // Propel
        $serviceContainer = Propel::getServiceContainer();
        $serviceContainer->setAdapterClass('code2be', 'mysql');
        $manager = new ConnectionManagerSingle();
        $manager->setConfiguration(array (
          'dsn'      => 'mysql:host='.$yaml['database']['host'].';dbname='.$yaml['database']['name'].';charset=UTF8',
          'user'     => $yaml['database']['user'],
          'password' => $yaml['database']['password'],
        ));
        $serviceContainer->setConnectionManager('code2be', $manager);
    }
}
