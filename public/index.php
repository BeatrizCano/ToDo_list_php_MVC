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
      <div class="card-header bg-success text-white">
        TODO LIST
      </div>
      <div class="card-body bg-light">
    
     
        <div class="mb-3">
          <form action="../app/controllers/addTask.php" method="post">           
            <label for="task">Task:</label>
            <input type="text" 
              class="form-control" 
              name="task" id="task" 
              placeholder="Write your task">

            <label for="description">Description:</label>
            <input type="text" 
              class="form-control" 
              name="description" id="description" 
              placeholder="Write your description">

            <label for="task-due-date">Task due date: </label>
            <input type="text" 
              class="form-control" 
              name="task-due-date" id="task-due-date" 
              placeholder="YYYY/MM/DD">
                    
            <br>
            <button type="submit" class="btn btn-success" name="action" value="add">Add task</button>
          </form>
        </div>


        <ul class="list-group">
          <?php include '../app/controllers/tasks.php'; ?>
        </ul>
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

