<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 via-gay-500 to-white-500 text-gray-200 min-h-screen">

   <nav class="bg-blue-900 p-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between">
            <h1 class="text-white text-3xl font-extrabold">Gestión</h1>
            <ul class="flex space-x-4 text-lg font-semibold">
                <li>
                    <a href="../index.php" class="hover:text-blue-300 transition duration-300">Inicio</a>
                </li>
                <li>
                    <a href="create.php" class="hover:text-blue-300 transition duration-300">Crear</a>
                </li>
                <li>
                    <a href="list.php" class="hover:text-blue-300 transition duration-300">Listar</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Contenido Principal -->
    <main class="container mx-auto mt-12 p-6">
        <div class="bg-white p-8 rounded-lg shadow-xl">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">Estudiantes Asignados a Cursos</h2>
            
            <table class="min-w-full bg-white border border-gray-800 rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200 text-left text-gray-800 font-semibold">ID Estudiante</th>
                        <th class="py-3 px-4 bg-gray-200 text-left text-gray-800 font-semibold">Nombre Estudiante</th>
                        <th class="py-3 px-4 bg-gray-200 text-left text-gray-800 font-semibold">ID Curso</th>
                        <th class="py-3 px-4 bg-gray-200 text-left text-gray-800 font-semibold">Nombre Curso</th>
                        <th class="py-3 px-4 bg-gray-200 text-left text-gray-800 font-semibold">Fecha de Inscripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require '../conf/database.php';

                    // Consulta SQL para obtener los estudiantes asignados a los cursos
                    $sql = "SELECT 
    estudiantes.estu_id AS estu_id,
    CONCAT(estudiantes.estu_primer_nombre, ' ', estudiantes.estu_primer_apellido) AS estudiante_nombre,
    cursos.curs_id AS curs_id,
    cursos.curs_nombre AS curs_nombre,
    inscripciones.insc_fecha_inscripcion AS insc_fecha_inscripcion,
    inscripciones.insc_id AS insc_id,
    inscripciones.insc_estado AS insc_estado
FROM 
    inscripciones
JOIN 
    estudiantes ON inscripciones.insc_estudiante_id = estudiantes.estu_id
JOIN 
    cursos ON inscripciones.insc_curso_id = cursos.curs_id
WHERE 
    estudiantes.estu_estado = 'A'
ORDER BY 
    cursos.curs_id
";

                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='text-gray-800 hover:bg-gray-100'>";
                        echo "<td class='border px-4 py-2 '>" . htmlspecialchars($row['estu_id']) . "</td>";
                        echo "<td class='border px-4 py-2 '>" . htmlspecialchars($row['estudiante_nombre']) . "</td>";
                        echo "<td class='border px-4 py-2 '>" . htmlspecialchars($row['curs_id']) . "</td>";
                        echo "<td class='border px-4 py-2 '>" . htmlspecialchars($row['curs_nombre']) . "</td>";
                        echo "<td class='border px-4 py-2 '>" . htmlspecialchars($row['insc_fecha_inscripcion']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
