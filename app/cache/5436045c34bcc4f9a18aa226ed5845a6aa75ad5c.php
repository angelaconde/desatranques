

<?php $__env->startSection('cuerpo'); ?>

    <div class="container-fluid">

        <div class="page-header">
            <h1>Lista de tareas</h1>
        </div>

        <?php

        // CONEXION A LA BASE DE DATOS
        include 'models/connection.php';
        $con = DB::getcon();

        // PROVINCIAS
        include 'models/provincias.php';

        // PAGINACION
        $pagina = isset($_GET['page']) ? $_GET['page'] : 1;
        $tareasPorPagina = 5;
        $desde = ($tareasPorPagina * $pagina) - $tareasPorPagina;

        // OBTENER LAS SIGUIENTES 5 TAREAS Y SUS DATOS
        $query = "SELECT * FROM tareas ORDER BY fecha_creacion DESC LIMIT :desde, :tareasPorPagina";
        $stmt = $con->prepare($query);
        $stmt->bindParam(":desde", $desde, PDO::PARAM_INT);
        $stmt->bindParam(":tareasPorPagina", $tareasPorPagina, PDO::PARAM_INT);
        $stmt->execute();
        // NUMERO TOTAL DE RESULTADOS OBTENIDOS
        $num = $stmt->rowCount();

        // ENLACE A CREAR TAREA
        echo "<a href='models/crear.php' class='btn btn-primary m-b-1em'>Añadir nueva tarea</a>";

        // COMPROBACION DE QUE HAYA RESULTADOS
        if ($num > 0) {

            echo "<table class='table table-hover table-responsive table-bordered'>";
            echo "<tr>";
            echo "<th>Contacto</th>";
            echo "<th>Teléfono</th>";
            echo "<th>Email</th>";
            echo "<th>Descripción</th>";
            echo "<th>Dirección</th>";
            echo "<th>Población</th>";
            echo "<th>CP</th>";
            echo "<th>Provincia</th>";
            echo "<th>Estado</th>";
            echo "<th>Fecha de creación</th>";
            echo "<th>Operario</th>";
            echo "<th>Fecha de realización</th>";
            echo "<th>Anotaciones anteriores</th>";
            echo "<th>Anotaciones posteriores</th>";
            echo "</tr>";

            while ($tarea = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // EXTRAE LA FILA PARA CONVERTIR $fila['campo'] EN $campo
                extract($tarea);
                // FILA EN LA TABLA
                echo "<tr>";
                echo "<td>{$contacto}</td>";
                echo "<td>{$telefono}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$descripcion}</td>";
                echo "<td>{$direccion}</td>";
                echo "<td>{$poblacion}</td>";
                echo "<td>{$cp}</td>";
                // PROVINCIA A LA QUE CORRESPONDE EL CODIGO
                // $sqlProv = 'SELECT nombre FROM provincias WHERE cod = ?';
                // $stmtProv = $con->prepare($sqlProv);
                // $stmtProv->execute([$provincia]);
                // $nombreProvincia = $stmtProv->fetchColumn();
                $nombreProvincia = provCodANombre($con, $provincia);
                echo "<td>{$nombreProvincia}</td>";
                // FIN DE PROVINCIA
                echo "<td>{$estado}</td>";
                echo "<td>{$fecha_creacion}</td>";
                echo "<td>{$operario}</td>";
                echo "<td>{$fecha_realizacion}</td>";
                echo "<td>{$anotaciones_anteriores}</td>";
                echo "<td>{$anotaciones_posteriores}</td>";
                echo "<td>";
                // VER TAREA 
                echo "<a href='models/tarea.php?id={$tarea_id}' class='btn btn-info'><i class='fas fa-file-alt'></i></a>";
                // EDITAR TAREA
                echo "<a href='models/editar.php?id={$tarea_id}' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                // ELIMINAR TAREA
                echo "<a href='#' onclick='borrar_tarea({$tarea_id});'  class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
            // PAGINACION
            // NUMERO TOTAL DE FILAS
            $query = "SELECT COUNT(*) as total_rows FROM tareas";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalFilas = $row['total_rows'];
            $paginaUrl = "lista?";
            include_once "views/paginacion.php";
        }

        // SI NO HAY RESULTADOS
        else {
            echo "<div class='alert alert-danger'>No hay ninguna tarea.</div>";
        }
        ?>

    </div>

</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desatranques\app\views/lista.blade.php ENDPATH**/ ?>