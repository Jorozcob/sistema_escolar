<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $sql = "DELETE FROM inscripciones WHERE insc_id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id])) {
            // Redireccionar al índice después de crear el curso
        header("Location: index.php");
        exit(); // Asegura que se detiene la ejecución del script 
        } else {
            echo "Error al eliminar la inscripción.";
        }
    } else {
        echo "ID no válido.";
    }
}

