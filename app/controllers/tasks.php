<?php
// Importar la clase DatabaseConnection
require_once __DIR__ . '/../database/DatabaseConnection.php';
// Importar los archivos de configuración
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/configTest.php';

// Importar la clase TaskModel
require_once __DIR__ . '/../models/TaskModel.php';
// Importar la clase TaskController
require_once __DIR__ . '/../controllers/TaskController.php';

use app\database\DatabaseConnection;

// Crear una instancia de la clase DatabaseConnection para obtener la conexión a la base de datos
$comm = DatabaseConnection::getConnection();
// Obtener el nombre de la tabla según el entorno (para pruebas o desarrollo)
$tableName = DatabaseConnection::getTableName();

// Crear una instancia del modelo Task y pasar la conexión PDO al constructor
$taskModel = new TaskModel($comm, $tableName);

// Crear una instancia del modelo TaskController y pasar la conexión PDO al constructor
$taskController = new TaskController($comm, $taskModel);

// Verificar si se ha enviado un ID para eliminar una tarea
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $taskController->deleteTask($id);
        header('Location: ../../public/index.php');
        exit();
    }
}

// Verificar si se ha enviado un ID para actualizar una tarea
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $taskController->displayModifyTask($id);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit']) && $_POST['submit'] === 'update') {
        // Aquí puedes procesar la actualización de la tarea
        // Puedes obtener los valores del formulario utilizando $_POST

        // Ejemplo:
        $id = $_POST['id'];
        $task = $_POST['task'];
        $description = $_POST['description'];
        $taskDueDate = $_POST['task-due-date'];

        // Llama al método correspondiente en el modelo para actualizar la tarea
        $taskModel->updateModifyTask($task, $description, $taskDueDate, $id);

        // Redirigir a la página principal después de la actualización
        header('Location: ../../public/index.php');
        exit();
    }
}


// Verificar qué acción se debe realizar según el parámetro "action" enviado por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'update':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $completed = isset($_POST['task_check']) ? 1 : 0;
                    $taskModel->updateTask($id, $completed);
                }
                break;
        }
    } else {
        if (isset($_POST['task'])) {
            $task = $_POST['task'];
            $taskModel->addTask($task);
        }
    }

    // Redirigir a la página principal después de realizar una acción
    header('Location: ../../public/index.php');
    exit();
}

// Obtener todas las tareas
$records = $taskModel->getAllTasks();


// Mostrar las tareas
foreach ($records as $record) {
    echo '<li class="list-group-item">';
    echo '<form action="../app/controllers/tasks.php" method="post">';
    echo '<div class="form-check">';
    echo '<input class="form-check-input" type="checkbox" name="task_check" value="1" onchange="this.form.submit()" ' . ($record['completada'] == 1 ? 'checked' : '') . '>';
    echo '<span class="float-start ' . ($record['completada'] == 1 ? 'underlined' : '') . '">'.'<br><span><strong>Task: </strong></span>' . $record['tarea'].'<br><span><strong>Description: </strong></span>'.$record['descripcion'].'<br><span><strong>Task due date: </strong></span>'.$record['fecha_vencimiento']. '</span>';
    echo '<input type="hidden" name="id" value="' . $record['id'] . '">';
    echo '<input type="hidden" name="action" value="update">';
    echo '</div>';
    echo '</form>';
    echo '<a href="../app/controllers/tasks.php?action=delete&id=' . $record['id'] . '" class="float-end mx-2"><span class="badge bg-danger">X</span></a>';
    echo '<a href="../app/controllers/tasks.php?action=update&id=' . $record['id'] . '" class="float-end"><span class="badge bg-warning"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
    </svg></span></a>';    
    echo '</li>';
  }
  
?>
