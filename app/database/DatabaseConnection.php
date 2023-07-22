<?php

namespace app\database;
require_once __DIR__ . '/../../config/config.php';
require_once realpath(__DIR__ . '/../../config/configTest.php');

class DatabaseConnection {
    public static function getConnection() {
      
        $isTestEnvironment = defined('TEST_ENVIRONMENT') && TEST_ENVIRONMENT;

        $configFile = $isTestEnvironment ? 'configTest.php' : 'config.php';

        $config = require __DIR__ . '/../../config/' . $configFile;

        $dsn = 'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'];
        $username = $config['db_user'];
        $password = $config['db_password'];

        return new \PDO($dsn, $username, $password); 
    }

    public static function getTableName() {
        
        return defined('TEST_ENVIRONMENT') && TEST_ENVIRONMENT ? 'tasks_test' : 'tasks';
    }
}

?>

