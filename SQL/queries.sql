SELECT * FROM asistencia_alumnos ORDER BY alumno_id;

# GET alumnos WITH asistencia AND falta count IN date RANGE 

SELECT alumnos.nombre, 
SUM(CASE WHEN status = 'asistencia' THEN 1 ELSE 0 END) AS contador_asistencia,
SUM(CASE WHEN status = 'falta' THEN 1 ELSE 0 END) AS contador_falta 
FROM asistencia_alumnos
INNER JOIN alumnos ON alumnos.id = asistencia_alumnos.alumno_id
WHERE date >= '2020-11-01' AND date <= '2020-11-16'
GROUP BY alumno_id;