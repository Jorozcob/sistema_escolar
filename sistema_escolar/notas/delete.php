<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $sql = "DELETE FROM notas WHERE nota_id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id])) {
            header("Location: index.php");
        exit();
        } else {
            echo "Error al eliminar la nota.";
        }
    } else {
        echo "ID no válido.";
    }
    
}

