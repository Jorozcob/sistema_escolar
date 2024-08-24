<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $profesor_input = $_POST['profesor_id'];
    $curso_input = $_POST['curso_id'];
    
    $profesor_id = intval(explode(' - ', $profesor_input)[0]);
    
    $curso_id = intval(explode(' - ', $curso_input)[0]);

    if ($profesor_id > 0 && $curso_id > 0) {
        $sql = "INSERT INTO profesores_cursos (prof_curs_profesor_id, prof_curs_curso_id) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$profesor_id, $curso_id])) {
            echo "Asignación creada exitosamente.";
            header("Location: index.php");
            exit(); 
        } else {
            echo "Error al crear la asignación.";
        }
    } else {
        echo "Datos no válidos.";
    }
}

// Obtener datos de profesores activos
$profesores_query = "SELECT prof_id, CONCAT(prof_id, ' - ', prof_primer_nombre, ' ', prof_primer_apellido) AS profesor FROM profesores WHERE prof_estado = 'A'";
$profesores_stmt = $pdo->query($profesores_query);
$profesores = $profesores_stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Crear Asignación de Profesor a Curso</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Crear Asignación de Profesor a Curso</h2>
        
        <div class="mb-4">
            <label for="profesor_id" class="block text-gray-700 font-semibold mb-2">Profesor:</label>
            <input type="text" name="profesor_id" id="profesor_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Escribe el ID del profesor o nombre">
        </div>
        <div class="mb-4">
            <label for="curso_id" class="block text-gray-700 font-semibold mb-2">Curso:</label>
            <input type="text" name="curso_id" id="curso_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Escribe el ID del curso o nombre">
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Crear Asignación
        </button>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profesores = <?php echo json_encode(array_column($profesores, 'profesor')); ?>;
            const cursos = <?php echo json_encode(array_column($cursos, 'curso')); ?>;
            new Awesomplete(document.getElementById('profesor_id'), {
                list: profesores,
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