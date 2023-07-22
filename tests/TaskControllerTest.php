<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use app\database\DatabaseConnection;
use PDO;
require_once __DIR__ . '/../config/configTest.php';
require_once __DIR__ . '/../app/controllers/TaskController.php';
require_once __DIR__ . '/../app/models/TaskModel.php';

class TaskControllerTest extends TestCase {
    public function testIndex() {
    
        $pdo = DatabaseConnection::getConnection();

        $stmt = $pdo->prepare('INSERT INTO tasks_test (tarea_test, descripcion_test, fecha_vencimiento_test) VALUES (?, ?, ?)');
        $stmt->execute(['Grabar video', 'Que sea corto y bonito', '2023-07-20']);
        $stmt->execute(['Preparar evento', 'Hablar con María', '2023-07-30']);
        $stmt->execute(['Llamar a la abuela', 'Felicitar cumpleaños', '2023-08-19',]);

        $taskModel = new \TaskModel($pdo, 'tasks_test');

        $taskController = new \TaskController();

        $taskController->setConnection($pdo);
        $taskController->setTaskModel($taskModel);

        $result = $taskController->index();
        var_dump($result); 
        $this->assertIsArray($result);

        $expected = [
            [
                'tarea_test' => 'Grabar video',
                'descripcion_test' => 'Que sea corto y bonito',
                'fecha_vencimiento_test' => '2023-07-20',
            ],
            [
                'tarea_test' => 'Preparar evento',
                'descripcion_test' => 'Hablar con María',
                'fecha_vencimiento_test' => '2023-07-30',
            ],
            [
                'tarea_test' => 'Llamar a la abuela',
                'descripcion_test' => 'Felicitar cumpleaños',
                'fecha_vencimiento_test' => '2023-08-19',
            ],
        ];

        $this->assertEquals($expected, $result);
    }
}
