<?php
require '../conf/database.php';

// Consulta para obtener la lista de estudiantes con sus cursos e inscripciones
$sql = "SELECT concat('Estudiante: ', estu_id, ' ', estu_primer_nombre, ' ', estu_primer_apellido, ' - ', 'Curso: ', curs_nombre) as estudiante, insc_id
        FROM estudiantes
        JOIN inscripciones ON insc_estudiante_id = estu_id
        JOIN cursos ON curs_id = insc_curso_id";
$stmt = $pdo->query($sql);
$estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inscripcion_id = filter_var($_POST['inscripcion_id'], FILTER_SANITIZE_NUMBER_INT);
    $valor = filter_var($_POST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $fecha = htmlspecialchars(trim($_POST['fecha']));

    if (filter_var($inscripcion_id, FILTER_VALIDATE_INT) && filter_var($valor, FILTER_VALIDATE_FLOAT) && !empty($fecha)) {
        $sql = "INSERT INTO notas (nota_inscripcion_id, nota_valor, nota_fecha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$inscripcion_id, $valor, $fecha])) {
            echo "Nota creada exitosamente.";
            header("Location: index.php");
            exit();
        } else {
            echo "Error al crear la nota.";
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
    <title>Crear Nota</title>
    
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Crear Nota</h2>
        <a href="index.php" class="bg-white text-indigo-600 py-2 px-4 rounded-lg font-medium hover:bg-indigo-50 transition duration-300">Regresar</a>
        <div class="mb-4">
            <label for="inscripcion_id" class="block text-gray-700 font-semibold mb-2">Estudiante y Curso:</label>
            <select name="inscripcion_id" id="inscripcion_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Seleccione un estudiante</option>
                <?php foreach ($estudiantes as $estudiante): ?>
                    <option value="<?php echo htmlspecialchars($estudiante['insc_id']); ?>">
                        <?php echo htmlspecialchars($estudiante['estudiante']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="valor" class="block text-gray-700 font-semibold mb-2">Valor de la Nota:</label>
            <input type="number" step="0.01" name="valor" id="valor" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="fecha" class="block text-gray-700 font-semibold mb-2">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Crear Nota
        </button>
    </form>
</body>
</html>
