<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 via-gray-300 to-white-500 text-gray-200 min-h-screen">

    <!-- Navegación -->
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

    <div class="bg-white p-8 rounded-lg shadow-xl">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">Listado de Estudiantes</h2>
            
            <table class="min-w-full bg-white border border-gray-800 rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200 text-left text-gray-800 font-semibold">ID Estudiante</th>
                        <th class="py-3 px-4 bg-gray-200 text-left text-gray-800 font-semibold">Nombre Estudiante</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require '../conf/database.php';

                    // Consulta SQL para obtener los estudiantes asignados a los cursos
                    $sql = "SELECT * FROM estudiantes WHERE estu_estado = 'A'";

                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { //Generan las filas
                        echo "<tr class='text-gray-800 hover:bg-gray-100'>";
                        echo "<td class='border px-4 py-2 '>" . htmlspecialchars($row['estu_id']) . "</td>";
                        echo "<td class='border px-4 py-2 '>" . htmlspecialchars($row['estu_primer_nombre']) . ' ' . htmlspecialchars($row['estu_primer_apellido']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

</body>

</html>
