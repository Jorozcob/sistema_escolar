<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
       
        if (!isset($_GET['id'])) {
            throw new Exception("ID no proporcionado.");
        }

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); 

        // Verifica si el ID es válido
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            throw new Exception("ID no válido.");
        }

        $sql = "UPDATE estudiantes SET estu_estado = 'R' WHERE estu_id = ?";
        $stmt = $pdo->prepare($sql);
        if (!$stmt->execute([$id])) {
            throw new Exception("Error al ejecutar la consulta SQL.");
        }

        header("Location: index.php");
        exit(); // Asegura que se detiene la ejecución del script

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


