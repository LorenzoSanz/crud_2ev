<?php
if (!isset($_POST["nombre"]) || !isset($_POST["dni"]) || !isset($_POST["curso"]) || !isset($_POST["iban"]) || !isset($_POST["posicion"]) || !isset($_POST["id"])) {
    exit("Faltan datos");
}
include_once "functions.php";
$nombre = $_POST["nombre"];
$dni = $_POST["dni"];
$curso = $_POST["curso"];
$iban = $_POST["iban"];
$posicion = $_POST["posicion"];
$id = $_POST["id"];

actualizarAlumno($nombre, $dni, $curso, $iban, $posicion, $id);
header("Location: alumnos.php");

