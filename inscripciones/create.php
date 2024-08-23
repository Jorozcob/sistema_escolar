<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estudiante_input = $_POST['estudiante_id'];
    $curso_input = $_POST['curso_id'];
    $fecha_inscripcion = htmlspecialchars(trim($_POST['fecha_inscripcion']));

    // Extraer el ID del estudiante
    $estudiante_id = intval(explode(' - ', $estudiante_input)[0]);
    
    
    $curso_id = intval(explode(' - ', $curso_input)[0]);
    

    if ($estudiante_id > 0 && $curso_id > 0 && !empty($fecha_inscripcion)) {
        $sql = "INSERT INTO inscripciones (insc_estudiante_id, insc_curso_id, insc_fecha_inscripcion) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$estudiante_id, $curso_id, $fecha_inscripcion])) {
            echo "Inscripción creada exitosamente.";
            
            header("Location: index.php");
            exit(); 
        } else {
            echo "Error al crear la inscripción.";
        }
    } else {
        echo "Datos no válidos.";
    }
}

// Obtener datos de estudiantes activos
$estudiantes_query = "SELECT estu_id, CONCAT(estu_id, ' - ', estu_primer_nombre, ' ', estu_primer_apellido) AS estudiante FROM estudiantes WHERE estu_estado = 'A'";
$estudiantes_stmt = $pdo->query($estudiantes_query);
$estudiantes = $estudiantes_stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener datos de cursos
$cursos_query = "SELECT curs_id, CONCAT(curs_id, ' - ', curs_nombre) AS curso FROM cursos";
$cursos_stmt = $pdo->query($cursos_query);
$cursos = $cursos_stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.css">
    <title>Crear Inscripción</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Crear Inscripción</h2>
        
        <div class="mb-4">
            <label for="estudiante_id" class="block text-gray-700 font-semibold mb-2">Estudiante:</label>
            <input type="text" name="estudiante_id" id="estudiante_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="ID del estudiante o nombre">
        </div>

        <div class="mb-4">
            <label for="curso_id" class="block text-gray-700 font-semibold mb-2">Curso:</label>
            <input type="text" name="curso_id" id="curso_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="ID del curso o nombre">
        </div>

        <div class="mb-4">
            <label for="fecha_inscripcion" class="block text-gray-700 font-semibold mb-2">Fecha de Inscripción:</label>
            <input type="date" name="fecha_inscripcion" id="fecha_inscripcion" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Crear Inscripción
        </button>
        
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const estudiantes = <?php echo json_encode(array_column($estudiantes, 'estudiante')); ?>;
            const cursos = <?php echo json_encode(array_column($cursos, 'curso')); ?>;

            new Awesomplete(document.getElementById('estudiante_id'), {
                list: estudiantes,
                minChars: 1,
                autoFirst: true
            });

            new Awesomplete(document.getElementById('curso_id'), {
                list: cursos,
                minChars: 1,
                autoFirst: true
            });
        });
    </script>
</body>
</html>