<?php 
include_once "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); 

    try {
        $db = getDatabase();
        $stmt = $db->prepare("INSERT INTO usuarios (usuario, contraseña) VALUES (?, ?)");
        $stmt->execute([$usuario, $contraseña]);
        echo "Usuario registrado exitosamente.";
        header ("Location: alumnos.php");
    } catch(PDOException $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}
?>
