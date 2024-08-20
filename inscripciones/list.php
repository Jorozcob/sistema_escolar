<?php
require '../conf/database.php';

$sql = "SELECT 
    estudiantes.estu_id AS estu_id,
    CONCAT(estudiantes.estu_primer_nombre, ' ', estudiantes.estu_primer_apellido) AS estudiante_nombre,
    cursos.curs_id AS curs_id,
    cursos.curs_nombre AS curs_nombre,
    inscripciones.insc_fecha_inscripcion AS insc_fecha_inscripcion,
    inscripciones.insc_id AS insc_id,
    inscripciones.insc_estado AS insc_estado
FROM 
    inscripciones
JOIN 
    estudiantes ON inscripciones.insc_estudiante_id = estudiantes.estu_id
JOIN 
    cursos ON inscripciones.insc_curso_id = cursos.curs_id
WHERE 
    estudiantes.estu_estado = 'A'
ORDER BY 
    cursos.curs_id;
";
$stmt = $pdo->query($sql);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Lista de Inscripciones</title>
</head>
<body class="bg-gray-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-white">Lista de Estudiantes asignados</h2>
                    <a href="index.php" class="bg-white text-indigo-600 py-2 px-4 rounded-lg font-medium hover:bg-indigo-50 transition duration-300">Regresar</a>
                </div>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Estudiante</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id Inscripcion</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($row['estu_id']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($row['estudiante_nombre'])   ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($row['curs_nombre'])  ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($row['insc_id']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($row['insc_estado']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="update.php?id=<?= htmlspecialchars($row['insc_id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Actualizar</a>
                                        <a href="delete.php?id=<?= htmlspecialchars($row['insc_id']) ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de que deseas eliminar?');">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>