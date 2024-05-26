<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-image: url("img/bg_registro.jpg");
            background-size: cover;
        }
        .vertical-center {
            min-height: 100vh; 
            display: flex;
            justify-content: center; 
            align-items: center; 
        }
    </style>
</head>
<body class="bg-light"> 
    <div class="container">
        <div class="row vertical-center">
            <div class="col-sm-10 col-md-8 col-lg-6"> 
                <div class="card shadow-sm"> 
                    <div class="card-header bg-info text-white text-bolder text-center" style="text-transform: uppercase; font-size: 24px;">
                        Registro
                    </div>
                    <div class="card-body">
                        <form action="procesar_registro.php" method="post">
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" id="usuario" name="usuario" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contraseña">Contraseña:</label>
                                <input type="password" id="contraseña" name="contraseña" class="form-control" required>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" value="Registrar" class="btn btn-info"> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
