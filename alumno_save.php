<?php
if (!isset($_POST["nombre"]) || !isset($_POST["dni"]) || !isset($_POST["curso"]) || !isset($_POST["iban"]) || !isset($_POST["posicion"])) {
    exit("Faltan datos. Por favor Introducelos");
}
include_once "functions.php";
$nombre = $_POST["nombre"];
$dni = $_POST["dni"];
$curso = $_POST["curso"];
$iban = $_POST["iban"];
$posicion = $_POST["posicion"];

añadeAlumno($nombre, $dni, $curso, $iban, $posicion);
header("Location: alumnos.php");
?>