<?php
require '../conf/database.php';

// Consulta para obtener las notas
$sql = "SELECT estu_id, concat(estu_primer_nombre,' ', estu_primer_apellido) nombre, 
nota_valor, curs_nombre, nota_fecha FROM notas
JOIN inscripciones on insc_id = nota_inscripcion_id
JOIN estudiantes on estu_id = insc_estudiante_id
JOIN cursos on curs_id = insc_curso_id";
$stmt = $pdo->query($sql);
?>

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
    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Notas</h2>

            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Id estudiante</th>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Nombre</th>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Curso</th>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Nota</th>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Fecha</th>
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
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
