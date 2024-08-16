<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $segundo_nombre = htmlspecialchars(trim($_POST['segundo_nombre']));
    $apellido = htmlspecialchars(trim($_POST['apellido']));
    $segundo_apellido = htmlspecialchars(trim($_POST['segundo_apellido']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && filter_var($id, FILTER_VALIDATE_INT)) {
        $sql = "UPDATE estudiantes SET estu_primer_nombre = ?, estu_segundo_nombre = ?, estu_primer_apellido = ?, estu_segundo_apellido = ?, estu_email = ? WHERE estu_id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nombre, $segundo_nombre, $apellido, $segundo_apellido, $email, $id])) {
            echo "Estudiante actualizado exitosamente.";
            header("Location: index.php"); // Redirige al índice después de la actualización
            exit(); // Asegura que se detiene la ejecución del script
        } else {
            echo "Error al actualizar el estudiante.";
        }
    } else {
        echo "Datos no válidos.";
    }
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM estudiantes WHERE estu_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$estudiante = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Actualizar Estudiante</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Actualizar Estudiante</h2>
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($estudiante['estu_id']); ?>">

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($estudiante['estu_primer_nombre']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="segundo_nombre" class="block text-gray-700 font-semibold mb-2">Segundo Nombre:</label>
            <input type="text" name="segundo_nombre" id="segundo_nombre" value="<?php echo htmlspecialchars($estudiante['estu_segundo_nombre']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="apellido" class="block text-gray-700 font-semibold mb-2">Apellido:</label>
            <input type="text" name="apellido" id="apellido" value="<?php echo htmlspecialchars($estudiante['estu_primer_apellido']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="segundo_apellido" class="block text-gray-700 font-semibold mb-2">Segundo Apellido:</label>
            <input type="text" name="segundo_apellido" id="segundo_apellido" value="<?php echo htmlspecialchars($estudiante['estu_segundo_apellido']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($estudiante['estu_email']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Actualizar Estudiante
        </button>
    </form>
</body>
</html>
