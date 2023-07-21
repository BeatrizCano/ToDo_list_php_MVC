<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use app\database\DatabaseConnection;
use PDO;
require_once __DIR__ . '/../config/configTest.php';

// Importar la clase TaskController
require_once __DIR__ . '/../app/controllers/TaskController.php';
// Importar la clase TaskModel (sin espacio de nombres ya que no está definido)
require_once __DIR__ . '/../app/models/TaskModel.php';

class TaskControllerTest extends TestCase {
    public function testIndex() {
        // Configurar la conexión a la base de datos de prueba
        $pdo = DatabaseConnection::getConnection();

        // Agregar tareas de prueba a la tabla tasks_test
        $stmt = $pdo->prepare('INSERT INTO tasks_test (tarea_test, descripcion_test, fecha_vencimiento_test) VALUES (?, ?, ?)');
        $stmt->execute(['Grabar video', 'Que sea corto y bonito', '2023-07-20']);
        $stmt->execute(['Preparar evento', 'Hablar con María', '2023-07-30']);
        $stmt->execute(['Llamar a la abuela', 'Felicitar cumpleaños', '2023-08-19',]);

        // Crear una instancia de TaskModel pasando la conexión y el nombre de la tabla
        $taskModel = new \TaskModel($pdo, 'tasks_test');

        // Crear una instancia de TaskController pasando el modelo
        $taskController = new \TaskController();

        // Establecer la conexión en el controlador mediante el método setConnection de TaskController para acceder a la conexión private
        $taskController->setConnection($pdo);

        // Establecer el modelo en el controlador utilizando el nuevo método setTaskModel
        $taskController->setTaskModel($taskModel);

        // Llamar a la función index en TaskController
        // La variable $result contiene el resultado real devuelto por la función index().
        $result = $taskController->index();
        var_dump($result); // Verificar el tipo de valor devuelto por la función index()

        // Verificar que el resultado es un array
        $this->assertIsArray($result);

        // Resultado esperado
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

        // Verificar si los dos valores son iguales.
        $this->assertEquals($expected, $result);
    }
}
