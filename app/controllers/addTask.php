<?php

require_once __DIR__ . '/../database/DatabaseConnection.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/configTest.php';
require_once __DIR__ . '/../models/TaskModel.php';


use app\database\DatabaseConnection;

$comm = DatabaseConnection::getConnection();
$tableName = DatabaseConnection::getTableName();

$taskModel = new TaskModel($comm, $tableName);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task'], $_POST['description'], $_POST['task-due-date'])) {
        $task = $_POST['task'];
        $description = $_POST['description'];
        $taskDueDate = $_POST['task-due-date'];
        $taskModel->addTask($task, $description, $taskDueDate);
    }
}

header('Location: ../../public/index.php');
exit();
?>


