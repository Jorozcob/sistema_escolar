<?php
require '../conf/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $sql = "DELETE FROM horarios WHERE hora_id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Horario eliminado exitosamente.";
        } else {
            echo "Error al eliminar el horario.";
        }
    } else {
        echo "ID no válido.";
    }
    if ($stmt->execute([$nombre, $descripcion])) {
        // Redireccionar al índice después de crear el curso
        header("Location: index.php");
        exit(); // Asegura que se detiene la ejecución del script
    } else {
        echo "Error al crear el curso.";
    }
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM horarios WHERE hora_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$horario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($horario['hora_id']); ?>">
    ¿Estás seguro que deseas eliminar el horario del curso con ID <?php echo htmlspecialchars($horario['hora_curso_id']); ?> para el día <?php echo htmlspecialchars($horario['hora_dia_semana']); ?>?
    <button type="submit">Eliminar Horario</button>
</form>
