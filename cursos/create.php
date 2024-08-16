<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));

    $sql = "INSERT INTO cursos (curs_nombre, curs_descripcion) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$nombre, $descripcion])) {
      header("Location: index.php");
      exit(); // Asegura que se detiene la ejecución del script
    } else {
        echo "Error al crear el curso.";
    }

}
?>

 <script src="https://cdn.tailwindcss.com"></script>
  <title>Crear Curso</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Crear Curso</h2>
    
    <div class="mb-4">
      <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre:</label>
      <input type="text" name="nombre" id="nombre" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    
    <div class="mb-4">
      <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción:</label>
      <textarea name="descripcion" id="descripcion" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>
    
    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
      Crear Curso
    </button>
  </form>
</body>