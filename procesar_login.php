<?php
session_start();
include_once "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['usuario']) && !empty($_POST['contraseña'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $db = getDatabase();
    $stmt = $db->prepare("SELECT id, contraseña FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($contraseña, $user ->{'contraseña'})) {
        $_SESSION['user_id'] = $user->id;
        header("Location: alumnos.php");
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
    }
} else {
    header("Location: login.php?error=2");
    exit();
}
?>
