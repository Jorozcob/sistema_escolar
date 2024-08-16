<?php
require '../conf/database.php';

// Obtener el ID del curso desde la URL (GET)
$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

// Verificar que el ID sea válido
if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
    echo "ID de curso no válido.";
    exit();
}

// Obtener los datos del curso de la base de datos
$sql = "SELECT * FROM cursos WHERE curs_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$curso = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar que se haya encontrado un curso
if (!$curso) {
    echo "Curso no encontrado.";
    exit();
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));

    if ($nombre && $descripcion) {
        $sql = "UPDATE cursos SET curs_nombre = ?, curs_descripcion = ? WHERE curs_id = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$nombre, $descripcion, $id])) {
            echo "Curso actualizado exitosamente.";
            header("Location: index.php");
            exit();
        } else {
            echo "Error al actualizar el curso.";
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
    <title>Actualizar Curso</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Actualizar Curso</h2>
        
        <!-- Campo oculto para almacenar el ID del curso -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($curso['curs_id']); ?>">

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($curso['curs_nombre']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($curso['curs_descripcion']); ?></textarea>
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Actualizar Curso
        </button>
    </form>
</body>
</html>
