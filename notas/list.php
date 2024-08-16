<?php
require '../conf/database.php';

// Consulta para obtener las notas junto con la información del estudiante y el curso
$sql = "SELECT nota_id, estu_id, concat(estu_primer_nombre,' ', estu_primer_apellido) as nombre, 
nota_valor, curs_nombre, nota_fecha 
FROM notas
JOIN inscripciones on insc_id = nota_inscripcion_id
JOIN estudiantes on estu_id = insc_estudiante_id
JOIN cursos on curs_id = insc_curso_id";
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Lista de Notas</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl">
  <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-white">Lista de notas</h2>
                    <a href="index.php" class="bg-white text-indigo-600 py-2 px-4 rounded-lg font-medium hover:bg-indigo-50 transition duration-300">Regresar</a>
                </div>
            </div>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-3 px-4 bg-gray-200 text-left text-gray-700 font-semibold">ID Estudiante</th>
                    <th class="py-3 px-4 bg-gray-200 text-left text-gray-700 font-semibold">Nombre</th>
                    <th class="py-3 px-4 bg-gray-200 text-left text-gray-700 font-semibold">Curso</th>
                    <th class="py-3 px-4 bg-gray-200 text-left text-gray-700 font-semibold">Nota</th>
                    <th class="py-3 px-4 bg-gray-200 text-left text-gray-700 font-semibold">Fecha</th>
                    <th class="py-3 px-4 bg-gray-200 text-left text-gray-700 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr class='hover:bg-gray-100'>";
                    echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['estu_id']) . "</td>";
                    echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['curs_nombre']) . "</td>";
                    echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['nota_valor']) . "</td>";
                    echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['nota_fecha']) . "</td>";
                    echo "<td class='border px-4 py-2 text-gray-800'>";
                    echo "<a href='update.php?id=" . htmlspecialchars($row['nota_id']) . "' class='bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded mr-2'>Editar</a>";
                    echo "<a href='delete.php?id=" . htmlspecialchars($row['nota_id']) . "' class='bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded' onclick=\"return confirm('¿Estás seguro de que deseas eliminar esta nota?');\">Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
