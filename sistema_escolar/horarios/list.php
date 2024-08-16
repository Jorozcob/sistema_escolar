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
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Lista de Horarios</h2>
        
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