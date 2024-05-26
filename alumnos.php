<?php
require "sesion.php"; 
include_once "header.php";
include_once "nav.php";
include_once "functions.php";

$alumnos = getAlumnos();
?>
<div class="row">
    <div class="col-12">
        <h1 class="display-4 text-center my-4">Alumnos</h1>
    </div>
    <div class="col-12">
        <a href="alumno_add.php" class="btn btn-info mb-2">Añadir Alumno <i class="fa fa-plus"></i></a>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Curso</th>
                        <th>IBAN</th>
                        <th>Comedor</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno) { ?>
                        <tr>
                            <td>
                                <?php echo $alumno->id ?>
                            </td>
                            <td>
                                <?php echo $alumno->nombre ?>
                            </td>
                            <td>
                                <?php echo $alumno->dni ?>
                            </td>
                            <td>
                                <?php echo $alumno->curso ?>
                            </td>
                            <td>
                                <?php echo $alumno->iban ?>
                            </td>
                            <td>
                                <?php echo $alumno->posicion ?>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="alumno_edit.php?id=<?php echo $alumno->id ?>">
                                Actualizar <i class="fa fa-edit"></i>
                            </a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="alumno_delete.php?id=<?php echo $alumno->id ?>">
                                Suprimir <i class="fa fa-trash"></i>
                            </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once "footer.php";
