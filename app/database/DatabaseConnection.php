<?php

namespace app\database;
require_once __DIR__ . '/../../config/config.php';
require_once realpath(__DIR__ . '/../../config/configTest.php');

class DatabaseConnection {
    public static function getConnection() {
        // Verificar si estamos en el entorno de pruebas
        $isTestEnvironment = defined('TEST_ENVIRONMENT') && TEST_ENVIRONMENT;

        // Obtener el nombre del archivo de configuración
        $configFile = $isTestEnvironment ? 'configTest.php' : 'config.php';

        // Incluir el archivo de configuración correcto
        $config = require __DIR__ . '/../../config/' . $configFile;

        $dsn = 'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'];
        $username = $config['db_user'];
        $password = $config['db_password'];

        return new \PDO($dsn, $username, $password); // Asegurarse de que se esté utilizando el PDO con la barra invertida para acceder a la clase global
    }

    public static function getTableName() {
        // En el entorno de pruebas, usar la tabla "tasks_test"
        // En el entorno de desarrollo, usar la tabla "tasks"
        return defined('TEST_ENVIRONMENT') && TEST_ENVIRONMENT ? 'tasks_test' : 'tasks';
    }
}

?>

