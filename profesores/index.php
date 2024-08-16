<?php
require '../conf/database.php';

// Consulta para obtener los profesores activos
$sql = "SELECT * FROM profesores WHERE prof_estado = 'A'";
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

<body class="bg-gradient-to-r from-blue-500 via-gray-500 to-white text-gray-200 min-h-screen">

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

    <!-- Contenido principal -->
    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Lista de Profesores</h2>

            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">ID</th>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Primer Nombre</th>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Segundo Nombre</th>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Primer Apellido</th>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Segundo Apellido</th>
                        <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='hover:bg-gray-100'>";
                        echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['prof_id']) . "</td>";
                        echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['prof_primer_nombre']) . "</td>";
                        echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['prof_segundo_nombre']) . "</td>";
                        echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['prof_primer_apellido']) . "</td>";
                        echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['prof_segundo_apellido']) . "</td>";
                        echo "<td class='border px-4 py-2 text-gray-800'>" . htmlspecialchars($row['prof_email']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
