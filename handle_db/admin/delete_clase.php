<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

if (isset($_POST['materia_id'])) {
    $materia_id = $_POST['materia_id'];

    // Desasignar la clase del maestro
    $comando_desasignar = $pdo->prepare("DELETE FROM maestros_materias WHERE materia_id = :materia_id");
    $comando_desasignar->execute(['materia_id' => $materia_id]);

    // Eliminar la clase de la tabla materias
    $comando_eliminar_clase = $pdo->prepare("DELETE FROM materias WHERE materia_id = :materia_id");
    $comando_eliminar_clase->execute(['materia_id' => $materia_id]);
}

// Redirigir al usuario de regreso a la página de clases
header("Location: /views/admin/clases.php");
?>
