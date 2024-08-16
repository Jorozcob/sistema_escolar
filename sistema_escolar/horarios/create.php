<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso_id = filter_var($_POST['curso_id'], FILTER_SANITIZE_NUMBER_INT);
    $dia_semana = htmlspecialchars(trim($_POST['dia_semana']));
    $hora_inicio = htmlspecialchars(trim($_POST['hora_inicio']));
    $hora_fin = htmlspecialchars(trim($_POST['hora_fin']));

    if (filter_var($curso_id, FILTER_VALIDATE_INT) && !empty($dia_semana) && !empty($hora_inicio) && !empty($hora_fin)) {
        $sql = "INSERT INTO horarios (hora_curso_id, hora_dia_semana, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$curso_id, $dia_semana, $hora_inicio, $hora_fin])) {
            echo "Horario creado exitosamente.";
        } else {
            echo "Error al crear el horario.";
        }
    } else {
        echo "Datos no válidos.";
    }
    if ($stmt->execute([$nombre, $descripcion])) {
        // Redireccionar al índice después de crear el curso
        header("Location: index.php");
        exit(); // Asegura que se detiene la ejecución del script
    } else {
        echo "Error al crear el curso.";
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>
    <title>Crear Horario</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Crear Horario</h2>
        
        <div class="mb-4">
            <label for="curso_id" class="block text-gray-700 font-semibold mb-2">ID del Curso:</label>
            <input type="number" name="curso_id" id="curso_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="dia_semana" class="block text-gray-700 font-semibold mb-2">Día de la Semana:</label>
            <select name="dia_semana" id="dia_semana" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miércoles">Miércoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sábado">Sábado</option>
                <option value="Domingo">Domingo</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="hora_inicio" class="block text-gray-700 font-semibold mb-2">Hora de Inicio:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="hora_fin" class="block text-gray-700 font-semibold mb-2">Hora de Fin:</label>
            <input type="time" name="hora_fin" id="hora_fin" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Crear Horario
        </button>
    </form>
</body>