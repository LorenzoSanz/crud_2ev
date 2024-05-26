<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <style>
        html, body {
            height: 100%;
            background-image: url("img/bg_login.jpg");
            background-size: cover; 
            background-position: center; 
        }
        form {
            width: 350px;
        }
    </style>
</head>
<body class="text-center d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="form-signin">
        <form action="procesar_login.php" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
            <br>
            <label for="usuario" class="sr-only">Usuario:</label>
            <input type="text" id="usuario" class="form-control" name="usuario" placeholder="Usuario" autofocus>
            <br>
            <label for="contraseña" class="sr-only">Contraseña:</label>
            <input type="password" id="contraseña" class="form-control" name="contraseña" placeholder="Contraseña">
            <br>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_GET['error'] == '1' ? "Usuario o contraseña incorrectos." : "Por favor, completa todos los campos." ?>
                </div>
                <script>
                    history.replaceState({}, '', 'login.php');
                </script>
            <?php endif; ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesión</button>
            <p class="mt-5 mb-3 text-muted">¿No tienes cuenta? <a href="registro.php">Crea una aquí!</a></p>
        </form>
    </div>
</body>
</html>
