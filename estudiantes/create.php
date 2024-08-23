<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $segundo_nombre = htmlspecialchars(trim($_POST['segundo_nombre']));
    $apellido = htmlspecialchars(trim($_POST['apellido']));
    $segundo_apellido = htmlspecialchars(trim($_POST['segundo_apellido']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "INSERT INTO estudiantes (estu_primer_nombre, estu_segundo_nombre, estu_primer_apellido, estu_segundo_apellido, estu_email)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nombre, $segundo_nombre, $apellido, $segundo_apellido, $email])) {
         header("Location: index.php");
        exit();
        } else {
            echo "Error al crear el estudiante.";
        }
    } else {
        echo "Email no válido.";
    }
   
}
?>

<script src="https://cdn.tailwindcss.com"></script>
    <title>Crear Estudiante</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Crear Estudiante</h2>
        
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-4">
            <label for="segundo_nombre" class="block text-gray-700 font-semibold mb-2">Segundo Nombre:</label>
            <input type="text" name="segundo_nombre" id="segundo_nombre" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-4">
            <label for="apellido" class="block text-gray-700 font-semibold mb-2">Apellido:</label>
            <input type="text" name="apellido" id="apellido" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-4">
            <label for="segundo_apellido" class="block text-gray-700 font-semibold mb-2">Segundo Apellido:</label>
            <input type="text" name="segundo_apellido" id="segundo_apellido" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
            <input type="email" name="email" id="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Crear Estudiante
        </button>
    </form>
</body>