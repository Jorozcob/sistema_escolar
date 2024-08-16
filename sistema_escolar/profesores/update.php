<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $primer_nombre = htmlspecialchars(trim($_POST['primer_nombre']));
    $segundo_nombre = htmlspecialchars(trim($_POST['segundo_nombre']));
    $primer_apellido = htmlspecialchars(trim($_POST['primer_apellido']));
    $segundo_apellido = htmlspecialchars(trim($_POST['segundo_apellido']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && filter_var($id, FILTER_VALIDATE_INT)) {
        $sql = "UPDATE profesores SET prof_primer_nombre = ?, prof_segundo_nombre = ?, prof_primer_apellido = ?, prof_segundo_apellido = ?, prof_email = ? WHERE prof_id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $email, $id])) {
            echo "Profesor actualizado exitosamente.";
            // Redirigir al índice después de actualizar el profesor
            header("Location: index.php");
            exit(); // Asegura que se detiene la ejecución del script
        } else {
            echo "Error al actualizar el profesor.";
        }
    } else {
        echo "Datos no válidos.";
    }
}

// Obtener los datos del profesor para llenar el formulario
$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM profesores WHERE prof_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$profesor = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Actualizar Profesor</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Actualizar Profesor</h2>
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($profesor['prof_id']); ?>">

        <div class="mb-4">
            <label for="primer_nombre" class="block text-gray-700 font-semibold mb-2">Primer Nombre:</label>
            <input type="text" name="primer_nombre" id="primer_nombre" value="<?php echo htmlspecialchars($profesor['prof_primer_nombre']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="segundo_nombre" class="block text-gray-700 font-semibold mb-2">Segundo Nombre:</label>
            <input type="text" name="segundo_nombre" id="segundo_nombre" value="<?php echo htmlspecialchars($profesor['prof_segundo_nombre']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="primer_apellido" class="block text-gray-700 font-semibold mb-2">Primer Apellido:</label>
            <input type="text" name="primer_apellido" id="primer_apellido" value="<?php echo htmlspecialchars($profesor['prof_primer_apellido']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="segundo_apellido" class="block text-gray-700 font-semibold mb-2">Segundo Apellido:</label>
            <input type="text" name="segundo_apellido" id="segundo_apellido" value="<?php echo htmlspecialchars($profesor['prof_segundo_apellido']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($profesor['prof_email']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Actualizar Profesor
        </button>
    </form>
</body>
</html>