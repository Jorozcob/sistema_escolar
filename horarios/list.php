<?php
require '../conf/database.php';

$sql = "SELECT * FROM horarios";
$stmt = $pdo->query($sql);
?>
<script src="https://cdn.tailwindcss.com"></script>
    <title>Lista de Horarios</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-white">Lista de Horarios</h2>
                    <a href="index.php" class="bg-white text-indigo-600 py-2 px-4 rounded-lg font-medium hover:bg-indigo-50 transition duration-300">Regresar</a>
                </div>
            </div>        
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">ID</th>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Curso ID</th>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Día de la Semana</th>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Hora de Inicio</th>
                    <th class="py-2 px-4 bg-gray-200 text-left text-gray-700">Hora de Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['hora_id']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['hora_curso_id']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['hora_dia_semana']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['hora_inicio']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['hora_fin']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>