<?php

// Importar la clase DatabaseConnection
require_once __DIR__ . '/../database/DatabaseConnection.php';
// Importar los archivos de configuración
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/configTest.php';
// Importar la clase TaskModel
require_once __DIR__ . '/../models/TaskModel.php';


use app\database\DatabaseConnection;

// Crear una instancia de la clase DatabaseConnection para obtener la conexión a la base de datos
$comm = DatabaseConnection::getConnection();
// Obtener el nombre de la tabla según el entorno (para pruebas o desarrollo)
$tableName = DatabaseConnection::getTableName();

// Crear una instancia del modelo Task y pasar la conexión PDO al constructor
$taskModel = new TaskModel($comm, $tableName);

// Verificar si se ha enviado el formulario de agregar tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task'], $_POST['description'], $_POST['task-due-date'])) {
        $task = $_POST['task'];
        $description = $_POST['description'];
        $taskDueDate = $_POST['task-due-date'];
        $taskModel->addTask($task, $description, $taskDueDate);
    }
}

// Redirigir a la página principal después de agregar una tarea
header('Location: ../../public/index.php');
exit();
?>


