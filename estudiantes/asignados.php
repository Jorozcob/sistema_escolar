<?php
require '../conf/database.php';

// Consulta SQL para obtener los estudiantes asignados a los cursos
$sql = "SELECT 
            estudiantes.estu_id,
            CONCAT(estudiantes.estu_primer_nombre, ' ', estudiantes.estu_primer_apellido) AS estudiante_nombre,
            cursos.curs_id,
            cursos.curs_nombre,
            inscripciones.insc_fecha_inscripcion
        FROM 
            inscripciones
        JOIN 
            estudiantes ON inscripciones.insc_estudiante_id = estudiantes.estu_id
        JOIN 
            cursos ON inscripciones.insc_curso_id = cursos.curs_id
        ORDER BY 
            cursos.curs_nombre, estudiantes.estu_primer_apellido";

$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Estudiantes Asignados a Cursos</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-6xl">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Estudiantes Asignados a Cursos</h2>
        
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">ID Estudiante</th>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Nombre Estudiante</th>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">ID Curso</th>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Nombre Curso</th>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Fecha de Inscripción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['estu_id']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['estudiante_nombre']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['curs_id']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['curs_nombre']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['insc_fecha_inscripcion']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
