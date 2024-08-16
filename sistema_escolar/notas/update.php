<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $inscripcion_id = filter_var($_POST['inscripcion_id'], FILTER_SANITIZE_NUMBER_INT);
    $valor = filter_var($_POST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $fecha = htmlspecialchars(trim($_POST['fecha']));

    if (filter_var($id, FILTER_VALIDATE_INT) && filter_var($inscripcion_id, FILTER_VALIDATE_INT) && filter_var($valor, FILTER_VALIDATE_FLOAT) && !empty($fecha)) {
        $sql = "UPDATE notas SET nota_inscripcion_id = ?, nota_valor = ?, nota_fecha = ? WHERE nota_id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$inscripcion_id, $valor, $fecha, $id])) {
            echo "Nota actualizada exitosamente.";
            // Redirigir al índice después de actualizar la nota
            header("Location: index.php");
            exit();
        } else {
            echo "Error al actualizar la nota.";
        }
    } else {
        echo "Datos no válidos.";
    }
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM notas WHERE nota_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$nota = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Actualizar Nota</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Actualizar Nota</h2>
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($nota['nota_id']); ?>">

        <div class="mb-4">
            <label for="inscripcion_id" class="block text-gray-700 font-semibold mb-2">ID de Inscripción:</label>
            <input type="number" name="inscripcion_id" id="inscripcion_id" value="<?php echo htmlspecialchars($nota['nota_inscripcion_id']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="valor" class="block text-gray-700 font-semibold mb-2">Valor de la Nota:</label>
            <input type="number" step="0.01" name="valor" id="valor" value="<?php echo htmlspecialchars($nota['nota_valor']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="fecha" class="block text-gray-700 font-semibold mb-2">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($nota['nota_fecha']); ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Actualizar Nota
        </button>
    </form>
</body>
</html>
