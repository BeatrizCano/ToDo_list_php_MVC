<?php

require_once __DIR__ . '/../database/DatabaseConnection.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/configTest.php';
require_once __DIR__ . '/../models/TaskModel.php';

class TaskController {
    private $comm;
    protected $taskModel;
    private $tableName;

    public function __construct() {
        $this->comm = \app\database\DatabaseConnection::getConnection(); 
        $this->tableName = \app\database\DatabaseConnection::getTableName(); 
        $this->taskModel = new TaskModel($this->comm, $this->tableName);
    }


    public function setConnection(PDO $pdo) {
        $this->comm = $pdo;
    }

    public function setTaskModel(TaskModel $taskModel) {
        $this->taskModel = $taskModel;
    }

    public function index() {
        
        $sql = "SELECT * FROM {$this->tableName}"; 
        $stmt = $this->comm->query($sql);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $records;    

        include '../../public/index.php';
        exit();
    }
    
    public function addTask() {
       
        if (isset($_POST['add_task'])) {
            $task = $_POST['task'];

            $sql = 'INSERT INTO tasks (tarea) VALUES (?)';
            $judgment = $this->comm->prepare($sql);
            $judgment->execute([$task]);
        }

        header('Location: ../../public/index.php');
        exit;
    }

    public function updateTask() {
    
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $task_check = isset($_POST['task_check']) ? 1 : 0;

            $sql = "UPDATE tasks SET completada=? WHERE id=?";
            $judgment = $this->comm->prepare($sql);
            $judgment->execute([$task_check, $id]);
        }

        header('Location: ../../public/index.php');
        exit;
    }

    public function displayModifyTask($id) {
       
        $task = $this->taskModel->getTaskById($id);

        include '../../public/modifyTask.php';
        exit();
    }

    public function updateModifyTask($task, $description, $taskDueDate, $id) {
        $this->taskModel->updateModifyTask($task, $description, $taskDueDate, $id);

        header('Location: ../../public/index.php');
        exit();
    }

    public function deleteTask() {
       
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "DELETE FROM tasks WHERE id=?";
            $judgment = $this->comm->prepare($sql);
            $judgment->execute([$id]);
        }

        header('Location: ../../public/index.php');
        exit;
    }
}
?>
