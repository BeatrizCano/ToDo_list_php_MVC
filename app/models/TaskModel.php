<?php
class TaskModel {
    private $comm;
    private $tableName; // Agregar una propiedad para almacenar el nombre de la tabla

    public function __construct(PDO $comm, $tableName) {
        $this->comm = $comm;
        $this->tableName = $tableName;
    }

    public function getAllTasks() {
        $sql = "SELECT * FROM {$this->tableName} ORDER BY fecha_vencimiento ASC";
        $stmt = $this->comm->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTask($task, $description, $taskDueDate) {
        $sql = 'INSERT INTO tasks (tarea, descripcion, fecha_vencimiento) VALUES (?,?, ?)';
        $stmt = $this->comm->prepare($sql);
        $stmt->execute([$task, $description, $taskDueDate]);
    }

    public function updateTask($id, $completed) {
        $sql = "UPDATE tasks SET completada=? WHERE id=?";
        $stmt = $this->comm->prepare($sql);
        $stmt->execute([$completed, $id]);
    }

    public function getTaskById($id) {
        $sql = "SELECT * FROM tasks WHERE id=?";
        $stmt = $this->comm->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateModifyTask($task, $description, $taskDueDate, $id) {
        $sql = "UPDATE tasks SET tarea=?, descripcion=?, `fecha_vencimiento`=? WHERE id=?";
        $stmt = $this->comm->prepare($sql);
        $stmt->execute([$task, $description, $taskDueDate, $id]);
    }

    public function deleteTask($id) {
        $sql = "DELETE FROM tasks WHERE id=?";
        $stmt = $this->comm->prepare($sql);
        $stmt->execute([$id]);
    }
    
}
?>
