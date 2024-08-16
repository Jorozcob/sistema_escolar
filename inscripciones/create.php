<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estudiante_id = filter_var($_POST['estudiante_id'], FILTER_SANITIZE_NUMBER_INT);
    $curso_id = filter_var($_POST['curso_id'], FILTER_SANITIZE_NUMBER_INT);
    $fecha_inscripcion = htmlspecialchars(trim($_POST['fecha_inscripcion']));

    if (filter_var($estudiante_id, FILTER_VALIDATE_INT) && filter_var($curso_id, FILTER_VALIDATE_INT) && !empty($fecha_inscripcion)) {
        $sql = "INSERT INTO inscripciones (insc_estudiante_id, insc_curso_id, insc_fecha_inscripcion) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$estudiante_id, $curso_id, $fecha_inscripcion])) {
            echo "Inscripción creada exitosamente.";
            // Redirigir al índice después de crear la inscripción
            header("Location: index.php");
            exit(); // Asegura que se detiene la ejecución del script
        } else {
            echo "Error al crear la inscripción.";
        }
    } else {
        echo "Datos no válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Crear Inscripción</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Crear Inscripción</h2>
        
        <div class="mb-4">
            <label for="estudiante_id" class="block text-gray-700 font-semibold mb-2">ID del Estudiante:</label>
            <input type="number" name="estudiante_id" id="estudiante_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="curso_id" class="block text-gray-700 font-semibold mb-2">ID del Curso:</label>
            <input type="number" name="curso_id" id="curso_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="fecha_inscripcion" class="block text-gray-700 font-semibold mb-2">Fecha de Inscripción:</label>
            <input type="date" name="fecha_inscripcion" id="fecha_inscripcion" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Crear Inscripción
        </button>
    </form>
</body>
</html>
