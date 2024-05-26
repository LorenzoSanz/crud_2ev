<?php
if (!isset($_GET["id"])) {
    exit("Falta la id, introdúcela porfavor.");
}
include_once "functions.php";
$id = $_GET["id"];
borrarAlumno($id);
header("Location: alumnos.php");
