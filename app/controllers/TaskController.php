<?php
// Importar la clase DatabaseConnection
require_once __DIR__ . '/../database/DatabaseConnection.php';
// Importar los archivos de configuración
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/configTest.php';
// Importar la clase TaskModel
require_once __DIR__ . '/../models/TaskModel.php';

class TaskController {
    private $comm;
    protected $taskModel;
    private $tableName; // Agregar una propiedad para almacenar el nombre de la tabla

    public function __construct() {
        $this->comm = \app\database\DatabaseConnection::getConnection(); // Obtener la conexión desde DatabaseConnection
        $this->tableName = \app\database\DatabaseConnection::getTableName(); // Obtener el nombre de la tabla desde DatabaseConnection
        $this->taskModel = new TaskModel($this->comm, $this->tableName);// Pasar la conexión al constructor de TaskModel
    }

    // Agregar el método setConnection y setTaskModel para establecer la conexión (por ejemplocon TaskControllerTest)
    public function setConnection(PDO $pdo) {
        $this->comm = $pdo;
    }

    public function setTaskModel(TaskModel $taskModel) {
        $this->taskModel = $taskModel;
    }

    public function index() {
        // Solicitar los datos de la base de datos
        $sql = "SELECT * FROM {$this->tableName}"; // Utilizar el nombre de la tabla según el entorno
        $stmt = $this->comm->query($sql);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Devolver los datos de las tareas
        return $records;    

        // Cargar la vista correspondiente
        include '../../public/index.php';
        exit();
    }
    
    public function addTask() {
        // Validar si se ha presionado el botón "Add Task"
        if (isset($_POST['add_task'])) {
            $task = $_POST['task'];

            // Insertar en la tabla tasks el valor del campo tarea
            $sql = 'INSERT INTO tasks (tarea) VALUES (?)';
            $judgment = $this->comm->prepare($sql);
            $judgment->execute([$task]);
        }

        // Redirigir a la página principal
        header('Location: ../../public/index.php');
        exit;
    }

    public function updateTask() {
        // Validar si se ha enviado el ID y el estado de completado
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $task_check = isset($_POST['task_check']) ? 1 : 0;

            // Actualizar el estado de completado en la base de datos
            $sql = "UPDATE tasks SET completada=? WHERE id=?";
            $judgment = $this->comm->prepare($sql);
            $judgment->execute([$task_check, $id]);
        }


        // Redirigir a la página principal
        header('Location: ../../public/index.php');
        exit;
    }

    public function displayModifyTask($id) {
        // Obtener los detalles de la tarea actual
        $task = $this->taskModel->getTaskById($id);

        // Cargar la vista modifyTask.php con los detalles de la tarea
        include '../../public/modifyTask.php';
        exit();
    }

    public function updateModifyTask($task, $description, $taskDueDate, $id) {
        $this->taskModel->updateModifyTask($task, $description, $taskDueDate, $id);

        // Redirigir a la página principal
        header('Location: ../../public/index.php');
        exit();
    }

    public function deleteTask() {
        // Validar si se ha enviado el ID para eliminar una tarea
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Eliminar el registro de la base de datos
            $sql = "DELETE FROM tasks WHERE id=?";
            $judgment = $this->comm->prepare($sql);
            $judgment->execute([$id]);
        }

        // Redirigir a la página principal
        header('Location: ../../public/index.php');
        exit;
    }
}
?>
