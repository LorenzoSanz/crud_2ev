<?php
function getAlumnosWithAttendanceCount($start, $end)
{
    $query = "SELECT alumnos.nombre, 
    SUM(CASE WHEN estado = 'asistencia' THEN 1 ELSE 0 END) AS contador_asistencia,
    SUM(CASE WHEN estado = 'falta' THEN 1 ELSE 0 END) AS contador_falta 
    FROM asistencia_alumnos
    INNER JOIN alumnos ON alumnos.id = asistencia_alumnos.alumno_id
    WHERE date >= ? AND date <= ?
    GROUP BY alumno_id;";
    $db = getDatabase();
    $statement = $db->prepare($query);
    $statement->execute([$start, $end]);
    return $statement->fetchAll();
}

function saveAttendanceData($date, $alumnos)
{
    deleteAttendanceDataByDate($date);
    $db = getDatabase();
    $db->beginTransaction();
    $statement = $db->prepare("INSERT INTO asistencia_alumnos(alumno_id, date, estado) VALUES (?, ?, ?)");
    foreach ($alumnos as $alumno) {
        $statement->execute([$alumno->id, $date, $alumno->estado]);
    }
    $db->commit();
    return true;
}

function deleteAttendanceDataByDate($date)
{
    $db = getDatabase();
    $statement = $db->prepare("DELETE FROM asistencia_alumnos WHERE date = ?");
    return $statement->execute([$date]);
}
function getAttendanceDataByDate($date)
{
    $db = getDatabase();
    $statement = $db->prepare("SELECT alumno_id, estado FROM asistencia_alumnos WHERE date = ?");
    $statement->execute([$date]);
    return $statement->fetchAll();
}

function borrarAlumno($id)
{
    $db = getDatabase();
    $statement = $db->prepare("DELETE FROM alumnos WHERE id = ?");
    return $statement->execute([$id]);
}

function actualizarAlumno($nombre, $dni, $curso, $iban, $posicion, $id)
{
    $db = getDatabase();
    $statement = $db->prepare("UPDATE alumnos SET nombre = ?, dni = ?, curso = ?, iban = ?, posicion = ? WHERE id = ?");
    return $statement->execute([$nombre, $dni, $curso, $iban, $posicion, $id]);
}
function getAlumnoConId($id)
{
    $db = getDatabase();
    $statement = $db->prepare("SELECT id, nombre, dni, curso, iban, posicion FROM alumnos WHERE id = ?");
    $statement->execute([$id]);
    return $statement->fetchObject();
}

function añadeAlumno($nombre, $dni, $curso, $iban, $posicion)
{
    $db = getDatabase();
    $statement = $db->prepare("INSERT INTO alumnos(nombre, dni, curso, iban, posicion) VALUES (?, ?, ?, ?, ?)");
    return $statement->execute([$nombre, $dni, $curso, $iban, $posicion]);
}

function getAlumnos()
{
    $db = getDatabase();
    $statement = $db->query("SELECT id, nombre, dni, curso, iban, posicion FROM alumnos");
    return $statement->fetchAll();
}

function getVarFromEnvironmentVariables($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "env.php";
        if (!file_exists($file)) {
            throw new Exception("The environment file ($file) does not exists. Please create it");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("The specified key (" . $key . ") does not exist in the environment file");
    }
}

function getDatabase()
{
    $password = getVarFromEnvironmentVariables("MYSQL_PASSWORD");
    $user = getVarFromEnvironmentVariables("MYSQL_USER");
    $dbName = getVarFromEnvironmentVariables("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}
