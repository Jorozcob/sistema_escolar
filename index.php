<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Sistema de Gestión</title>
</head>
<body class="bg-gradient-to-r from-blue-500 via-gray-500 to-white-500 flex flex-col min-h-screen text-gray-200">

  <!-- Navegación -->
  <nav class="bg-blue-900 p-4 shadow-lg">
    <div class="container mx-auto">
      <ul class="flex justify-center space-x-8 text-white text-lg font-semibold">
        <li><a href="index.php" class="hover:text-gray-300 transition-colors duration-300">Inicio</a></li>
        <li><a href="estudiantes/index.php" class="hover:text-gray-300 transition-colors duration-300">Estudiantes</a></li>
        <li><a href="profesores/index.php" class="hover:text-gray-300 transition-colors duration-300">Profesores</a></li>
        <li><a href="horarios/index.php" class="hover:text-gray-300 transition-colors duration-300">Horarios</a></li>
        <li><a href="cursos/index.php" class="hover:text-gray-300 transition-colors duration-300">Cursos</a></li>
        <li><a href="inscripciones/index.php" class="hover:text-gray-300 transition-colors duration-300">Inscripciones</a></li>
        <li><a href="notas/index.php" class="hover:text-gray-300 transition-colors duration-300">Notas</a></li>
      </ul>
    </div>
  </nav>

  <!-- Contenido Principal -->
  <main class="flex-grow container mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg transform hover:scale-95 transition-transform duration-300">
      <h1 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">Bienvenido al Sistema de Gestión</h1>
      <p class="text-gray-600 text-lg text-center">Selecciona una opción del menú para comenzar.</p>
    </div>
  </main>

  <!-- Pie de página -->
  <footer class="bg-blue-900 text-white text-center p-4 mt-8">
    <p>&copy; 2024 Sistema de Gestión. Todos los derechos reservados.</p>
  </footer>
  
</body>
</html>
