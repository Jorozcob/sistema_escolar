<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        // Verifica si el ID ha sido enviado
        if (!isset($_GET['id'])) {
            throw new Exception("ID no proporcionado.");
        }

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        // Verifica si el ID es válido
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            throw new Exception("ID no válido.");
        }

        // Prepara y ejecuta la consulta SQL
        $sql = "UPDATE profesores SET prof_estado = 'R' WHERE prof_id = ?";
        $stmt = $pdo->prepare($sql);
        if (!$stmt->execute([$id])) {
            throw new Exception("Error al ejecutar la consulta SQL.");
        }

        // Si la actualización fue exitosa, redirige al usuario
        header("Location: index.php");
        exit(); // Asegura que se detiene la ejecución del script

    } catch (Exception $e) {
        // Muestra el mensaje de error para depuración
        echo "Error: " . $e->getMessage();
    }
}
?>
