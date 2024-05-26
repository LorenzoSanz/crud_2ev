<?php
require "sesion.php"; 
include_once "header.php";
include_once "nav.php";
if (!isset($_GET["id"])) exit("Falta la id, introdúcela porfavor.");
$id = $_GET["id"];
include_once "functions.php";
$alumno = getAlumnoConId($id);
?>
<div class="row">
    <div class="col-12">
        <h1 class="display-4 text-center my-4">Editar Alumnado</h1>
    </div>
    <div class="col-12">
        <form action="alumno_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $alumno->id; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input value="<?php echo $alumno->nombre; ?>" name="nombre" type="text" id="nombre" class="form-control" placeholder="NOMBRE" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" required>
                <br>
                <label for="dni">Identificación:</label>
                <input value="<?php echo $alumno->dni; ?>" name="dni" type="text" id="dni" class="form-control" placeholder="Formato DNI (Ej.: 12345678Z)" pattern="\d{8}[A-Za-z]" required>           
                <br>
                <label for="curso">Curso:</label>
                <select name="curso" id="curso" class="form-control" required>
                    <option value="<?php echo $alumno->curso; ?>">Curso Actual (<?php echo $alumno->curso; ?>)</option>
                    <option value="3INF">3INF</option>
                    <option value="4INF">4INF</option>
                    <option value="5INF">5INF</option>
                </select>
                <br>
                <label for="iban">Cuenta Bancaria:</label>
                <input value="<?php echo $alumno->iban; ?>" name="iban" type="text" id="iban" class="form-control" placeholder="Formato IBAN Español (Ej.: ES00 1234 5678 9012 3456 7890)" pattern="ES\d{2}\s?\d{4}\s?\d{4}\s?\d{4}\s?\d{4}\s?\d{4}" required>
                <br>
                <label for="posicion">Mesa del Comedor:</label>
                <select name="posicion" id="posicion" class="form-control" required>
                    <option value="<?php echo $alumno->posicion; ?>">Mesa Actual (<?php echo $alumno->posicion; ?>)</option>
                    <option value="Mesa 1">Mesa 1</option>
                    <option value="Mesa 2">Mesa 2</option>
                    <option value="Mesa 3">Mesa 3</option>
                    <option value="Mesa 4">Mesa 4</option>
                </select>
                <br>
            </div>
            <div class="form-group">
                <button class="btn btn-success my-5 mx-4">
                    Guardar Cambios <i class="fa fa-check"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "footer.php";
