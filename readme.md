<h1>TODO LIST EN PHP MVC</H1>

<p>Este proyecto se ha creado usando Xampp, MySQL, Composer y, PHPUnit para llevar a cabo el testing.</p>

<p>Una ToDo List es una aplicación simple pero útil que permite a los usuarios organizar y administrar sus tareas diarias. Este desarrollo requiere
 de una persona profesional en desarrollo web full stack, especialmente conocimientos sólidos en desarrollo del lado del servidor, modelado y gestión de bases de datos y por supuesto pruebas unitarias que garanticen un funcionamiento correcto.</p>

<h3>Instalaciones necesarias:</h3>
    <ul>
        <li>Xampp:
            <ul>
             <li>Configurar las variables de entorno en windows para incluir la ruta 'path.</li>
             <li>Visualizar datos en consola: 'php nombre_archivo.php'.</li>
            </ul>
         </li>
        <li>Composer</li>
            <li>Necesario para usar PHPUnit.</li>
        <li>PHP Unit</li>
            <li>Instalarlo a través de composer para que las versiones sean compatibles.</li>
            <li>Visualizar datos en consola: 'vendor/bin/phpunit'.</li>
    </ul>

<h3>Funcionalidades:</h3>
    <ul>
        <li>Crear tarea: Los usuarios pueden agregar nuevas tareas a la lista, proporcionando un título y una descripción.</li>
        <li>Leer tareas: Los usuarios pueden ver todas las tareas existentes en una lista.</li>
        <li>Marcar tarea como completada: Los usuarios pueden marcar una tarea como completada.</li>
        <li>Editar tarea: Los usuarios pueden editar el título y la descripción de una tarea existente.</li>
        <li>Eliminar tarea: Los usuarios pueden eliminar una tarea de la lista.</li>
        <li>Ordenar tareas: Los usuarios pueden ordenar las tareas por fecha de vencimiento.</li>
    </ul>

<h3>Organización del proyecto y herramientas:</h3>
    <ul>
        <li>Slidesgo: Historias de usuario: https://docs.google.com/presentation/d/1DVQWFji0CNaMXy4Dju6IzJpwdqd9T-0Kw_GhOsVujWc/edit#slide=id.g93d42c1dd5_0_79</li>
        <li>Trello: tablero 'product backlog': https://trello.com/b/PmOVrPuk/todo-list-php</li>
        <li>drawSQL: Modelado de datos: https://drawsql.app/teams/beatriz-cano-fernandez-team/diagrams/modelado-todo-list-php</li>
        <li>Visual Studio Code: Creación del código del proyecto usando Modelo Vista Controlador.</li>   
        <li>Bootstrap 5: para el diseño del frontend.</li>   
    </ul>

<h3>Organización del directorio de carpetas</h3>
    <ul>
        <li>Carpeta app: contiene el MVC propiamente dicho:
            <li>Carpeta controllers:actúa como intermediario entre el modelo y la vista. tomar los datos proporcionados por el cliente,<br> 
            interactuar con el modelo y devolver una respuesta apropiada al cliente </li>
            <li>Carpeta models: representa la lógica de negocio y los datos de la aplicación.Es responsable de interactuar con la base de datos y realizar operaciones como consultas, inserciones, 
            actualizaciones y eliminaciones.</li>
            <li>Carpeta views (vacía)</li>
            <li>Carpeta database: se encarga de la conexión con MySQL</li>
        </li>
        <li>Carpeta config: contiene los datos de conexión de las dos bases de datos y el booleano que define su uso.</li>
        <li>Carpeta public: contiene las vistas del formulario principal del proyecto y el de modificación de tareas.</li>
        <li>Carpeta test</li>
        <li>Carpeta vendor: se crea de forma automática al instalar Composer.</li>
        <li>composer.json y composer.lock: se crea de forma automática al instalar Composer.</li>
        <li>.phpunit.result.cache: se crea de forma autómatica al instalar PHPUnit.</li>
        <li>phpunit.xml: sirve para definir variables de entorno que te permiten conectar a una base de datos de prueba diferente.<br>
        y asegurarte de que las pruebas se ejecuten en ese entorno sin afectar a tu base de datos de producción.</li>
    </ul>

<h3>MySQL.Bases de datos</h3>
<ul>
<li>Se han creado dos bases de datos:
    <li>'todo_list'
        <li>'tasks'es la tabla que almacena los datos del formulario.</li>
        <li>'tasks_test'es la tabla que almacena los datos del test.</li>
    </li>
    <li>'todo_list_test' (en obras).
        <li>'tasks_test_enObras' se creó para almacenar los datos del test pero no se logró conectar con ella.</li>
    </li>
</li>
</ul>
