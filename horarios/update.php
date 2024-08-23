<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $curso_id = filter_var($_POST['curso_id'], FILTER_SANITIZE_NUMBER_INT);
    $dia_semana = htmlspecialchars(trim($_POST['dia_semana']));
    $hora_inicio = htmlspecialchars(trim($_POST['hora_inicio']));
    $hora_fin = htmlspecialchars(trim($_POST['hora_fin']));

    if (filter_var($id, FILTER_VALIDATE_INT) && filter_var($curso_id, FILTER_VALIDATE_INT) && !empty($dia_semana) && !empty($hora_inicio) && !empty($hora_fin)) {
        $sql = "UPDATE horarios SET hora_curso_id = ?, hora_dia_semana = ?, hora_inicio = ?, hora_fin = ? WHERE hora_id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$curso_id, $dia_semana, $hora_inicio, $hora_fin, $id])) {
            echo "Horario actualizado exitosamente.";
        } else {
            echo "Error al actualizar el horario.";
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


$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM horarios WHERE hora_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$horario = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<script src="https://cdn.tailwindcss.com"></script>
    <title>Actualizar Horario</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Actualizar Horario</h2>
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($horario['hora_id']); ?>">

        <div class="mb-4">
            <label for="curso_id" class="block text-gray-700 font-semibold mb-2">ID del Curso:</label>
            <input type="number" name="curso_id" id="curso_id" value="<?php echo htmlspecialchars($horario['hora_curso_id']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="dia_semana" class="block text-gray-700 font-semibold mb-2">Día de la Semana:</label>
            <select name="dia_semana" id="dia_semana" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Lunes" <?php echo $horario['hora_dia_semana'] == 'Lunes' ? 'selected' : ''; ?>>Lunes</option>
                <option value="Martes" <?php echo $horario['hora_dia_semana'] == 'Martes' ? 'selected' : ''; ?>>Martes</option>
                <option value="Miércoles" <?php echo $horario['hora_dia_semana'] == 'Miércoles' ? 'selected' : ''; ?>>Miércoles</option>
                <option value="Jueves" <?php echo $horario['hora_dia_semana'] == 'Jueves' ? 'selected' : ''; ?>>Jueves</option>
                <option value="Viernes" <?php echo $horario['hora_dia_semana'] == 'Viernes' ? 'selected' : ''; ?>>Viernes</option>
                <option value="Sábado" <?php echo $horario['hora_dia_semana'] == 'Sábado' ? 'selected' : ''; ?>>Sábado</option>
                <option value="Domingo" <?php echo $horario['hora_dia_semana'] == 'Domingo' ? 'selected' : ''; ?>>Domingo</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="hora_inicio" class="block text-gray-700 font-semibold mb-2">Hora de Inicio:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" value="<?php echo htmlspecialchars($horario['hora_inicio']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="hora_fin" class="block text-gray-700 font-semibold mb-2">Hora de Fin:</label>
            <input type="time" name="hora_fin" id="hora_fin" value="<?php echo htmlspecialchars($horario['hora_fin']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Actualizar Horario
        </button>
    </form>
</body>
