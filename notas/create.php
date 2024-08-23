<?php
require '../conf/database.php';

$sql_estudiantes = "SELECT CONCAT(estu_id, ' - ', estu_primer_nombre, ' ', estu_primer_apellido) as estudiante
                    FROM estudiantes
                    WHERE estu_estado = 'A'";
$stmt_estudiantes = $pdo->query($sql_estudiantes);
$estudiantes = $stmt_estudiantes->fetchAll(PDO::FETCH_ASSOC);

$sql_cursos = "SELECT CONCAT(curs_id, ' - ', curs_nombre) as curso
               FROM cursos";
$stmt_cursos = $pdo->query($sql_cursos);
$cursos = $stmt_cursos->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estudiante_input = $_POST['estudiante'];
    $curso_input = $_POST['curso'];
    $valor = filter_var($_POST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $fecha = htmlspecialchars(trim($_POST['fecha']));

    // Extraer los IDs
    $estudiante_id = intval(explode(' - ', $estudiante_input)[0]);
    $curso_id = intval(explode(' - ', $curso_input)[0]);

    $sql_inscripcion = "SELECT insc_id FROM inscripciones WHERE insc_estudiante_id = ? AND insc_curso_id = ?";
    $stmt_inscripcion = $pdo->prepare($sql_inscripcion);
    $stmt_inscripcion->execute([$estudiante_id, $curso_id]);
    $inscripcion = $stmt_inscripcion->fetch(PDO::FETCH_ASSOC);

    if ($inscripcion && filter_var($valor, FILTER_VALIDATE_FLOAT) && !empty($fecha)) {
        $sql = "INSERT INTO notas (nota_inscripcion_id, nota_valor, nota_fecha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$inscripcion['insc_id'], $valor, $fecha])) {
            echo "Nota creada exitosamente.";
            header("Location: index.php");
            exit();
        } else {
            echo "Error al crear la nota.";
        }
    } else {
        echo "Datos no válidos o el estudiante no está inscrito en el curso seleccionado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.css">
    <title>Crear Nota</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <a href="index.php" class="bg-blue-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-indigo-400 transition duration-300">Regresar</a>
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Crear Nota</h2>
        
        <div class="mb-4">
            <label for="estudiante" class="block text-gray-700 font-semibold mb-2">Estudiante:</label>
            <input type="text" name="estudiante" id="estudiante" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Buscar estudiante">
        </div>

        <div class="mb-4">
            <label for="curso" class="block text-gray-700 font-semibold mb-2">Curso:</label>
            <input type="text" name="curso" id="curso" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Buscar curso">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const estudiantes = <?php echo json_encode(array_column($estudiantes, 'estudiante')); ?>;
            const cursos = <?php echo json_encode(array_column($cursos, 'curso')); ?>;

            new Awesomplete(document.getElementById('estudiante'), {
                list: estudiantes,
                minChars: 1,
                autoFirst: true
            });

            new Awesomplete(document.getElementById('curso'), {
                list: cursos,
                minChars: 1,
                autoFirst: true
            });
        });
    </script>
</body>
</html>