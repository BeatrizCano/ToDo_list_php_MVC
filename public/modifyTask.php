<!doctype html>
<html lang="en">

<head>
  <title>Todo List PHP</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Estilos para subrayar la tarea cuando esté completada -->
  <style>
    .underlined { text-decoration: line-through; }
  </style>
</head>

<body>

  <main class="container">
    <br/>
    <div class="card">
      <div class="card-header bg-light">
        MODIFY YOUR TASK
      </div>
      <div class="card-body bg-success text-white">
        <div class="mb-3">
         <!--usar $_SERVER['PHP_SELF'] en el formulario del archivo modifyTask.php te dará la ruta correcta para enviar los datos a tasks.php, que sería algo como /Todo_list_MVC/app/controllers/tasks.php. 
         Esto evitará el problema del enlace repetido "app" en la URL. -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
            
            <div class="mb-3">
              <label for="task" class="form-label">Task:</label>
              <input type="text" name="task" value="<?php echo $task['tarea']; ?>" class="form-control">
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description:</label>
              <input type="text" name="description" value="<?php echo $task['descripcion']; ?>" class="form-control">
            </div>

            <div class="mb-3">
              <label for="task-due-date" class="form-label">Task due date:</label>
              <input type="text" name="task-due-date" value="<?php echo $task['fecha_vencimiento']; ?>" class="form-control">
            </div>

            <button type="submit" name="submit" value="update" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
        </svg> Save Modification </button>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>
   