<?php
require "sesion.php"; 
include_once "functions.php";
include_once "header.php";
include_once "nav.php";


$db = getDatabase();
$stmt = $db->prepare("SELECT * FROM cursos");
$stmt->execute(); 
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Cursos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <style>
        .card-header {
            background-color: black;   
            color: white;  
        }
        .list-group-flush:hover {
            background-color: darkgrey; 
        }
        .list-action-button {
            float: right; 
        }
    </style>
</head>
<body class="d-flex flex-column vh-100">
    <div class="container my-auto">
        <h1 class="display-4 text-center my-3">Listado de Cursos</h1>
        <?php foreach ($cursos as $curso): ?>
            <div class="card my-5">
                <div class="card-header text-center">
                    <h2 class="display-4  "><?= htmlspecialchars($curso['curso']) ?></h2>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    $alumnosQuery = $db->prepare("SELECT * FROM alumnos WHERE curso = ?");
                    $alumnosQuery->execute([$curso['curso']]);
                    $alumnos = $alumnosQuery->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($alumnos as $alumno):
                        echo "<li class='list-group-item list-group-item-action'>" . "<span class='font-weight-bold'>" . htmlspecialchars($alumno['nombre']) . "</span>" . "<a href='attendance_register.php?id=" . htmlspecialchars($alumno['id']) . "' class='btn btn-secondary btn-sm list-action-button'>Listar</a></li>";
                    endforeach;

                    if (empty($alumnos)) {
                        echo "<li class='list-group-item'>No hay alumnos inscritos en este curso.</li>";
                    }
                    ?>
                </ul>
            </div>
        <?php endforeach; 
        include_once "footer.php";?>
    </div>
</body>
</html>
