<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso_input = filter_var($_POST['curso_id'], FILTER_SANITIZE_NUMBER_INT);
    $dia_semana = htmlspecialchars(trim($_POST['dia_semana']));
    $hora_inicio = htmlspecialchars(trim($_POST['hora_inicio']));
    $hora_fin = htmlspecialchars(trim($_POST['hora_fin']));
    $curso_id = intval(explode(' - ', $curso_input)[0]);
    //Se verifica si el curso_id es un número entero válido y si los campos dia_semana, hora_inicio y hora_fin no están vacíos.
    if (filter_var($curso_id, FILTER_VALIDATE_INT) && !empty($dia_semana) && !empty($hora_inicio) && !empty($hora_fin)) {
        $sql = "INSERT INTO horarios (hora_curso_id, hora_dia_semana, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$curso_id, $dia_semana, $hora_inicio, $hora_fin])) {
             header("Location: index.php");
        exit(); 
        } else {
            echo "Error al crear el horario.";
        }
    } else {
        echo "Datos no válidos.";
    }
}
// Obterner los datos de los cursos
$cursos_query = "SELECT curs_id, CONCAT(curs_id, ' - ', curs_nombre) AS curso FROM cursos";
$cursos_stmt = $pdo->query($cursos_query);
$cursos = $cursos_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.css">
    <title>Crear Horario</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Crear Horario</h2>
        
       <div class="mb-4">
            <label for="curso_id" class="block text-gray-700 font-semibold mb-2">Curso:</label>
            <input type="text" name="curso_id" id="curso_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Escribe el ID del curso o nombre">
        </div>

        <div class="mb-4">
            <label for="dia_semana" class="block text-gray-700 font-semibold mb-2">Día de la Semana:</label>
            <select name="dia_semana" id="dia_semana" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miércoles">Miércoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sábado">Sábado</option>
                <option value="Domingo">Domingo</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="hora_inicio" class="block text-gray-700 font-semibold mb-2">Hora de Inicio:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="hora_fin" class="block text-gray-700 font-semibold mb-2">Hora de Fin:</label>
            <input type="time" name="hora_fin" id="hora_fin" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Crear Horario
        </button>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cursos = <?php echo json_encode(array_column($cursos, 'curso')); ?>;
           
            new Awesomplete(document.getElementById('curso_id'), {
                list: cursos,
                minChars: 1,
                autoFirst: true
            });
        });
        console.log(cursos);
    </script>
</body>