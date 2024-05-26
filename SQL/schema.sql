CREATE DATABASE IF NOT EXISTS web_asistencia;
USE web_asistencia;

DROP TABLE IF EXISTS asistencia_alumnos;
DROP TABLE IF EXISTS alumnos;
DROP TABLE IF EXISTS cursos;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS cursos (
    curso VARCHAR(4) NOT NULL PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS alumnos (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    dni VARCHAR(20) NOT NULL UNIQUE,
    curso VARCHAR (4), 
    iban VARCHAR(50),
    posicion VARCHAR(50),
    FOREIGN KEY (curso) REFERENCES cursos(curso) 
);

CREATE TABLE IF NOT EXISTS asistencia_alumnos (
    alumno_id BIGINT UNSIGNED NOT NULL,
    date VARCHAR(10) NOT NULL,
    estado ENUM('asistencia', 'falta'), 
    FOREIGN KEY (alumno_id) REFERENCES alumnos(id) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO cursos (curso) VALUES
('3INF'),
('4INF'),
('5INF');

